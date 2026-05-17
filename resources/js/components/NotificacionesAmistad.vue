<template>
    <li :class="[isMobileFloating ? 'list-none' : 'relative dropdown-container']" ref="btnContainer">
        <!-- BOTÓN EN MÓVIL (FLOTANTE) - Círculo blanco con sombra elegante y campana oscura, idéntico a la imagen -->
        <button v-if="isMobileFloating" @click.stop="toggle" 
                class="w-14 h-14 bg-white rounded-full shadow-[0_10px_25px_rgba(0,0,0,0.15)] flex items-center justify-center text-[#32424D] hover:text-[#C2841D] hover:scale-105 active:scale-95 transition-all focus:outline-none relative border border-gray-100">
            <i class="bi bi-bell-fill text-2xl"></i>
            <span v-if="count > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-black w-6 h-6 flex items-center justify-center rounded-full border-2 border-white shadow-sm">
                {{ count }}
            </span>
        </button>
        <!-- BOTÓN EN ESCRITORIO O MENÚ NORMAL -->
        <button v-else @click.stop="toggle" class="relative text-[#32424D] hover:text-[#C2841D] transition-colors p-2 flex items-center focus:outline-none uppercase font-black text-2xl lg:text-xl gap-4">
            <i class="bi bi-bell-fill text-2xl lg:text-xl"></i> Notificaciones
            <span v-if="count > 0" class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-black w-5 h-5 flex items-center justify-center rounded-full border-2 border-[#D4B830]">
                {{ count }}
            </span>
        </button>

        <Teleport to="body">
            <div v-if="isOpen" 
                 class="dropdown-content fixed z-[9999] bg-white rounded-[30px] shadow-2xl p-6 border border-gray-100 min-w-[300px]"
                 :style="dropdownStyle">
                <p class="text-[11px] font-black text-gray-400 uppercase text-center mb-4 tracking-widest">Solicitudes de Amistad</p>
                <ul class="space-y-4 max-h-[300px] overflow-y-auto custom-scrollbar">
                    <li v-for="sol in solicitudes" :key="sol.id" 
                        class="flex items-center justify-between gap-3 p-3 bg-gray-50 rounded-2xl border-2 border-gray-100">
                        <div class="flex items-center gap-3">
                            <img :src="sol.perfil_foto ? '/' + sol.perfil_foto : 'https://ui-avatars.com/api/?name=' + sol.name" 
                                 class="w-10 h-10 rounded-full border-2 border-white shadow-sm object-cover">
                            <span class="text-sm font-bold text-gray-700">{{ sol.name }}</span>
                        </div>
                        <div class="flex gap-2">
                            <a :href="'/perfil/' + sol.id" class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center hover:bg-indigo-200 transition-colors" title="Ver Perfil">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <button @click="aceptar(sol.id)" class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center hover:bg-green-200 transition-colors" title="Aceptar">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button @click="rechazar(sol.id)" class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-200 transition-colors" title="Rechazar">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </li>
                    <li v-if="count === 0" class="text-center py-4 text-gray-400 italic text-sm">No tienes solicitudes pendientes</li>
                </ul>
            </div>
        </Teleport>
    </li>
</template>

<script>
export default {
    props: {
        routeIndex: String,
        routeAceptar: String,
        routeRechazar: String,
        csrf: String,
        isMobileFloating: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            isOpen: false,
            count: 0,
            solicitudes: [],
            interval: null,
            dropdownStyle: {}
        }
    },
    mounted() {
        this.poll();
        this.interval = setInterval(this.poll, 7000);
        window.addEventListener('resize', this.handleResize);
        document.addEventListener('click', this.handleOutsideClick);
    },
    beforeUnmount() {
        clearInterval(this.interval);
        window.removeEventListener('resize', this.handleResize);
        document.removeEventListener('click', this.handleOutsideClick);
    },
    methods: {
        toggle() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.updateDropdownPosition();
            }
        },
        updateDropdownPosition() {
            if (!this.$refs.btnContainer) return;
            const rect = this.$refs.btnContainer.getBoundingClientRect();
            if (window.innerWidth >= 1024) {
                const topVal = Math.max(10, rect.top - 20);
                this.dropdownStyle = {
                    top: topVal + 'px',
                    left: '272px',
                    maxHeight: `calc(100vh - ${topVal + 20}px)`,
                    overflowY: 'auto'
                };
            } else {
                const topVal = rect.bottom + 10;
                if (this.isMobileFloating) {
                    this.dropdownStyle = {
                        top: topVal + 'px',
                        right: '24px',
                        maxHeight: `calc(100vh - ${topVal + 20}px)`,
                        overflowY: 'auto'
                    };
                } else {
                    this.dropdownStyle = {
                        top: topVal + 'px',
                        left: '50%',
                        transform: 'translateX(-50%)',
                        maxHeight: `calc(100vh - ${topVal + 20}px)`,
                        overflowY: 'auto'
                    };
                }
            }
        },
        handleResize() {
            if (this.isOpen) this.updateDropdownPosition();
        },
        handleOutsideClick(e) {
            if (this.isOpen && this.$refs.btnContainer && !this.$refs.btnContainer.contains(e.target)) {
                const dropdown = document.querySelector('.dropdown-content');
                if (dropdown && !dropdown.contains(e.target)) {
                    this.isOpen = false;
                }
            }
        },
        poll() {
            fetch(this.routeIndex)
                .then(r => r.json())
                .then(data => {
                    this.count = data.count;
                    this.solicitudes = data.solicitudes;
                });
        },
        aceptar(id) {
            fetch(this.routeAceptar.replace(':id', id), { 
                method: 'POST', 
                headers: { 'X-CSRF-TOKEN': this.csrf } 
            }).then(() => { 
                this.poll(); 
                if (window.Swal) window.Swal.fire('¡Amistad aceptada!', '', 'success'); 
            });
        },
        rechazar(id) {
            fetch(this.routeRechazar.replace(':id', id), { 
                method: 'POST', 
                headers: { 'X-CSRF-TOKEN': this.csrf } 
            }).then(() => { 
                this.poll(); 
            });
        }
    }
}
</script>
