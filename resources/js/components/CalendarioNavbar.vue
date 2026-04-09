<template>
    <component :is="isMobileMode ? 'div' : 'li'" class="relative" :class="isMobileMode ? 'flex-1 flex' : 'dropdown-container w-full'" ref="btnContainer">
        <button v-if="isMobileMode" @click.stop="toggle" class="flex-1 flex flex-col items-center justify-center gap-1 transition-all active:scale-90 focus:outline-none w-full" :class="isOpen ? 'text-[#bc6a50]' : 'text-[#32424D]/60'" :style="isOpen ? 'color: #bc6a50 !important;' : 'color: #32424Dbb !important;'">
            <i class="bi bi-calendar-check-fill text-[1.4rem]"></i>
            <span class="text-[10px] font-black uppercase leading-none">Citas</span>
        </button>
        <button v-else @click.stop="toggle"
            class="text-[#32424D] hover:text-[#C2841D] transition-colors flex items-center gap-3 w-full uppercase focus:outline-none">
            <span class="font-black text-xl lg:text-lg">Mis Actividades</span>
            <svg class="w-4 h-4 ms-2 transition-transform duration-300" :class="{'rotate-180': isOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <Teleport to="body">
            <div v-if="isOpen" v-click-outside="() => isOpen = false" @click.stop
                class="dropdown-content fixed z-[9999] bg-white rounded-[40px] shadow-2xl p-6 border-2 border-[#32424D]/10 min-w-[320px] md:min-w-[360px]"
                :style="dropdownStyle">
                
                <!-- Calendario Primero -->
                <div class="mb-2">
                    <div class="bg-indigo-50/30 rounded-[30px] p-2 border border-indigo-100/50">
                        <div ref="calendarEl" class="calendar-mini"></div>
                    </div>
                </div>

                <!-- Lista Después -->
                <div class="border-t border-gray-100 pt-4">
                    <p class="text-[11px] font-black text-gray-400 uppercase text-center mb-4 tracking-tighter">Tus próximas citas</p>
                    <ul class="space-y-3 max-h-[180px] overflow-y-auto pr-2 custom-scrollbar">
                        <li v-for="act in inscripciones" :key="act.fecha + act.nombre" 
                            class="flex items-center gap-3 p-3 rounded-2xl bg-gray-50 border-l-[4px] shadow-sm transform hover:scale-[1.02] transition-all"
                            :style="{ borderLeftColor: act.color }">
                            <div class="flex-1">
                                <p class="text-[#32424D] font-black text-sm uppercase leading-none mb-1">{{ act.nombre }}</p>
                                <p class="text-[10px] text-gray-500 font-bold italic">{{ act.fechaFormateada }}</p>
                            </div>
                        </li>
                        <li v-if="inscripciones.length === 0" class="text-sm text-gray-400 font-bold italic text-center py-4 bg-gray-50 rounded-2xl">
                            Aún no tienes planes
                        </li>
                    </ul>
                </div>
            </div>
        </Teleport>
    </component>
</template>

<script>
import flatpickr from 'flatpickr';
import { Spanish } from 'flatpickr/dist/l10n/es.js';

export default {
    props: {
        initialInscripciones: {},
        routeInscritas: {},
        isAuth: {},
        isMobileMode: {
            type: Boolean,
            default: false
        }
    },
    directives: {
        'click-outside': {
            mounted(el, binding) {
                el.clickOutsideEvent = (event) => {
                    if (!(el === event.target || el.contains(event.target))) {
                        binding.value();
                    }
                };
                document.addEventListener("click", el.clickOutsideEvent);
            },
            unmounted(el) {
                document.removeEventListener("click", el.clickOutsideEvent);
            },
        },
    },
    data() {
        let items = [];
        try {
            items = typeof this.initialInscripciones === 'string' 
                ? JSON.parse(this.initialInscripciones) 
                : (this.initialInscripciones || []);
        } catch (e) {
            console.error("Error parsing initialInscripciones:", e);
        }

        return {
            isOpen: false,
            inscripciones: items,
            fp: null,
            interval: null,
            dropdownStyle: {}
        }
    },
    methods: {
        toggle() {
            this.isOpen = !this.isOpen;
            console.log("Calendario toggle:", this.isOpen);
            if (this.isOpen) {
                this.updateDropdownPosition();
                this.$nextTick(() => {
                    this.initCalendar();
                });
            }
        },
        updateDropdownPosition() {
            if (!this.$refs.btnContainer) return;
            const rect = this.$refs.btnContainer.getBoundingClientRect();
            
            if (this.isMobileMode) {
                // Desplegar hacia arriba en móvil porque sale de la barra inferior
                const bottomVal = window.innerHeight - rect.top + 10;
                this.dropdownStyle = {
                    bottom: bottomVal + 'px',
                    left: '50%',
                    transform: 'translateX(-50%)',
                    maxHeight: `calc(100vh - ${bottomVal + 20}px)`,
                    overflowY: 'auto'
                };
            } else if (window.innerWidth >= 1024) {
                const topVal = Math.max(10, rect.top - 20);
                this.dropdownStyle = {
                    top: topVal + 'px',
                    left: '272px',
                    maxHeight: `calc(100vh - ${topVal + 20}px)`,
                    overflowY: 'auto'
                };
            } else {
                const topVal = rect.bottom + 10;
                this.dropdownStyle = {
                    top: topVal + 'px',
                    left: '50%',
                    transform: 'translateX(-50%)',
                    maxHeight: `calc(100vh - ${topVal + 20}px)`,
                    overflowY: 'auto'
                };
            }
        },
        handleResize() {
            if (this.isOpen) this.updateDropdownPosition();
        },
        initCalendar() {
            if (!this.$refs.calendarEl) return;

            // Destruir instancia previa si existe (v-if recrea el DOM)
            if (this.fp) {
                this.fp.destroy();
                this.fp = null;
            }

            try {
                this.fp = flatpickr(this.$refs.calendarEl, {
                    inline: true,
                    locale: Spanish,
                    onDayCreate: (dObj, dStr, fp, dayElem) => {
                        const f = dayElem.dateObj.toLocaleDateString('en-CA');
                        const act = this.inscripciones.find(a => a.fecha === f);
                        if (act) {
                            dayElem.classList.add("dia-resaltado");
                            dayElem.style.setProperty('--color-actividad', act.color);
                        }
                    }
                });
            } catch (e) {
                console.error("Flatpickr Error:", e);
            }
        },
        poll() {
            if (!this.isAuth) return;
            fetch(this.routeInscritas)
                .then(r => r.json())
                .then(data => {
                    if (data && JSON.stringify(data) !== JSON.stringify(this.inscripciones)) {
                        console.log("Nuevas inscripciones detectadas:", data.length);
                        this.inscripciones = data;
                        if (this.fp) this.fp.redraw();
                    }
                })
                .catch(err => console.error("Error polling inscripciones:", err));
        }
    },
    mounted() {
        console.log("CalendarioNavbar montado. Inscripciones iniciales:", this.inscripciones.length);
        if (this.isAuth) {
            this.interval = setInterval(this.poll, 10000);
            window.addEventListener('inscripcion-actualizada', this.poll);
        }
        window.addEventListener('resize', this.handleResize);
    },
    beforeUnmount() {
        if (this.interval) clearInterval(this.interval);
        window.removeEventListener('inscripcion-actualizada', this.poll);
        window.removeEventListener('resize', this.handleResize);
        if (this.fp) this.fp.destroy();
    }
}
</script>
