@extends('layout')

@section('title', 'Saber Más')

@section('contenido')
<div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-sm p-4 md:p-6 lg:p-8">
    <h2 class="m-0 mb-6 text-gray-800 text-2xl font-bold border-b pb-3 uppercase flex items-center gap-2">
        <i class="bi bi-info-circle text-[#bc6a50]" aria-hidden="true"></i> Saber Más
    </h2>

    <div v-pre x-data="{ 
        activeTab: 'video', 
        styleInactive: 'background: linear-gradient(to bottom, #ffffff 0%, #e2e8f0 49%, #cbd5e1 50%, #f1f5f9 100%); border: 1px solid #9ca3af; border-bottom: none; border-top-left-radius: 12px; border-top-right-radius: 12px; color: #475569; margin-right: -1px; padding: 10px 16px; font-size: 0.875rem; font-weight: bold; position: relative; z-index: 1; box-shadow: inset 0 1px 1px rgba(255,255,255,0.8); cursor: pointer; white-space: nowrap;',
        styleActiveVideo: 'background: linear-gradient(to bottom, #93c5fd 0%, #60a5fa 49%, #3b82f6 50%, #2563eb 100%); border: 1px solid #1d4ed8; border-bottom: none; border-top-left-radius: 12px; border-top-right-radius: 12px; color: white; margin-right: -1px; padding: 12px 16px 10px 16px; font-size: 0.875rem; font-weight: bold; position: relative; z-index: 10; box-shadow: inset 0 1px 2px rgba(255,255,255,0.8); text-shadow: 0 1px 1px rgba(0,0,0,0.2); cursor: default; white-space: nowrap;',
        styleActivePrivacidad: 'background: linear-gradient(to bottom, #86efac 0%, #4ade80 49%, #22c55e 50%, #16a34a 100%); border: 1px solid #15803d; border-bottom: none; border-top-left-radius: 12px; border-top-right-radius: 12px; color: white; margin-right: -1px; padding: 12px 16px 10px 16px; font-size: 0.875rem; font-weight: bold; position: relative; z-index: 10; box-shadow: inset 0 1px 2px rgba(255,255,255,0.8); text-shadow: 0 1px 1px rgba(0,0,0,0.2); cursor: default; white-space: nowrap;',
        styleActiveCookies: 'background: linear-gradient(to bottom, #fde047 0%, #facc15 49%, #eab308 50%, #ca8a04 100%); border: 1px solid #a16207; border-bottom: none; border-top-left-radius: 12px; border-top-right-radius: 12px; color: white; margin-right: -1px; padding: 12px 16px 10px 16px; font-size: 0.875rem; font-weight: bold; position: relative; z-index: 10; box-shadow: inset 0 1px 2px rgba(255,255,255,0.8); text-shadow: 0 1px 1px rgba(0,0,0,0.2); cursor: default; white-space: nowrap;',
        styleActiveSoporte: 'background: linear-gradient(to bottom, #d8b4fe 0%, #c084fc 49%, #a855f7 50%, #9333ea 100%); border: 1px solid #7e22ce; border-bottom: none; border-top-left-radius: 12px; border-top-right-radius: 12px; color: white; margin-right: -1px; padding: 12px 16px 10px 16px; font-size: 0.875rem; font-weight: bold; position: relative; z-index: 10; box-shadow: inset 0 1px 2px rgba(255,255,255,0.8); text-shadow: 0 1px 1px rgba(0,0,0,0.2); cursor: default; white-space: nowrap;',
        styleActiveOtros: 'background: linear-gradient(to bottom, #f3b19b 0%, #d47e62 49%, #bc6a50 50%, #bc6a50 100%); border: 1px solid #9a543e; border-bottom: none; border-top-left-radius: 12px; border-top-right-radius: 12px; color: white; margin-right: -1px; padding: 12px 16px 10px 16px; font-size: 0.875rem; font-weight: bold; position: relative; z-index: 10; box-shadow: inset 0 1px 2px rgba(255,255,255,0.8); text-shadow: 0 1px 1px rgba(0,0,0,0.2); cursor: default; white-space: nowrap;',
        getBarStyle() {
            let bg = '#2563eb'; let border = '#1d4ed8';
            if(this.activeTab === 'privacidad') { bg = '#16a34a'; border = '#15803d'; }
            if(this.activeTab === 'cookies') { bg = '#ca8a04'; border = '#a16207'; }
            if(this.activeTab === 'soporte') { bg = '#9333ea'; border = '#7e22ce'; }
            if(this.activeTab === 'otros') { bg = '#bc6a50'; border = '#9a543e'; }
            return `background-color: ${bg}; height: 12px; width: 100%; border-top: 1px solid ${border}; position: relative; z-index: 5; box-shadow: inset 0 3px 5px rgba(255,255,255,0.2), 0 2px 4px rgba(0,0,0,0.1); transition: background-color 0.2s, border-color 0.2s;`;
        },
        soporteForm: { name: '', email: 'tenderete2026@gmail.com', message: '' },
        isSubmitting: false
    }" class="flex flex-col gap-4 pb-4">

        <!-- SECCIÓN DE PESTAÑAS TIPO FOLDER -->
        <div class="flex-1 flex flex-col relative mt-2 w-full overflow-hidden">
        <!-- Ayuda móvil -->
        <p class="text-[10px] text-gray-400 italic mb-1 md:hidden text-center w-full uppercase tracking-widest font-bold animate-pulse"><i class="fa-solid fa-arrows-left-right mr-1"></i> Desliza para ver más apartados</p>
        
        <!-- Pestañas (Headers) -->
        <div class="flex items-end px-2 sm:px-4 overflow-x-auto w-full" style="border-bottom: 0; scrollbar-width: none; -ms-overflow-style: none;">
                
                <style>
                    /* Ocultar barra de scroll para pestañas en webkit */
                    .overflow-x-auto::-webkit-scrollbar { display: none; }
                </style>
                
                <button x-on:click="activeTab = 'video'"
                :style="activeTab === 'video' ? styleActiveVideo : styleInactive"
                class="flex items-center gap-2 focus:outline-none whitespace-nowrap">
                <i class="fa-solid fa-video"></i> Vídeo
            </button>
            
            <button x-on:click="activeTab = 'privacidad'"
                :style="activeTab === 'privacidad' ? styleActivePrivacidad : styleInactive"
                class="flex items-center gap-2 focus:outline-none whitespace-nowrap">
                <i class="fa-solid fa-user-shield"></i> Privacidad
            </button>
            
            <button x-on:click="activeTab = 'cookies'"
                :style="activeTab === 'cookies' ? styleActiveCookies : styleInactive"
                class="flex items-center gap-2 focus:outline-none whitespace-nowrap">
                <i class="fa-solid fa-cookie-bite"></i> Cookies
            </button>
            
            <button x-on:click="activeTab = 'soporte'"
                :style="activeTab === 'soporte' ? styleActiveSoporte : styleInactive"
                class="flex items-center gap-2 focus:outline-none whitespace-nowrap">
                <i class="fa-solid fa-headset"></i> Soporte
            </button>

            <button x-on:click="activeTab = 'otros'"
                :style="activeTab === 'otros' ? styleActiveOtros : styleInactive"
                class="flex items-center gap-2 focus:outline-none whitespace-nowrap">
                <i class="fa-solid fa-ellipsis-h"></i> Otros
            </button>
        </div>

        <!-- Barra gruesa debajo de las pestañas -->
        <div :style="getBarStyle()"></div>

        <!-- Contenido de las Pestañas -->
        <div class="flex-1 bg-white border border-gray-300 border-t-0 rounded-b-lg rounded-tr-lg p-6 shadow-sm overflow-y-auto min-h-[400px]">
            
            <!-- CONTENIDO VIDEO -->
            <div x-show="activeTab === 'video'" x-transition.opacity.duration.300ms class="flex flex-col gap-4">
                <h3 class="text-xl font-bold text-[#1e293b] border-b pb-2">Conoce Tenderete</h3>
                <div class="w-full max-w-2xl mx-auto">
                    <video id="mainVideo" src="{{ asset('vid.mp4') }}" autoplay muted loop controls class="w-full rounded-lg bg-black shadow-md"></video>
                </div>
                <div class="mt-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h4 class="text-[#bc6a50] text-sm font-semibold uppercase mb-2">Transcripción</h4>
                    <p class="text-[#3b4d57] text-sm leading-relaxed text-justify italic">
                        "Explora las actividades, añade nuevos amigos y organiza tu calendario sin complicaciones. Únete a nuestra comunidad y descubre todo lo que Tenderete tiene para ofrecerte."
                    </p>

                </div>
            </div>

            <!-- CONTENIDO PRIVACIDAD -->
            <div x-show="activeTab === 'privacidad'" x-transition.opacity.duration.300ms style="display: none;">
                <h3 class="text-xl font-bold text-[#1e293b] border-b pb-2 mb-4">Política de Privacidad</h3>
                <div class="prose max-w-none text-gray-700 text-sm">
                    <p class="mb-4">En Tenderete valoramos profundamente tu privacidad. Esta política describe cómo recopilamos, utilizamos y protegemos tu información personal cuando utilizas nuestra plataforma.</p>
                    <h4 class="font-bold text-gray-900 mt-4 mb-2">1. Información que recopilamos</h4>
                    <p class="mb-4">Recopilamos información que nos proporcionas directamente al crear una cuenta, actualizar tu perfil, o interactuar con otros usuarios y actividades en la plataforma.</p>
                    <h4 class="font-bold text-gray-900 mt-4 mb-2">2. Uso de la información</h4>
                    <p class="mb-4">Utilizamos tu información para proporcionarte una experiencia personalizada, facilitar la organización de eventos y mejorar continuamente nuestros servicios.</p>
                    <h4 class="font-bold text-gray-900 mt-4 mb-2">3. Protección de datos</h4>
                    <p>Implementamos medidas de seguridad técnicas y organizativas para proteger tus datos personales contra el acceso no autorizado, alteración, divulgación o destrucción.</p>
                </div>
            </div>

            <!-- CONTENIDO COOKIES -->
            <div x-show="activeTab === 'cookies'" x-transition.opacity.duration.300ms style="display: none;">
                <h3 class="text-xl font-bold text-[#1e293b] border-b pb-2 mb-4">Política de Cookies</h3>
                <div class="prose max-w-none text-gray-700 text-sm">
                    <p class="mb-4">Nuestra plataforma utiliza cookies para mejorar tu experiencia de navegación, analizar el tráfico del sitio y personalizar el contenido.</p>
                    <h4 class="font-bold text-gray-900 mt-4 mb-2">¿Qué son las cookies?</h4>
                    <p class="mb-4">Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas un sitio web. Nos ayudan a recordar tus preferencias y entender cómo interactúas con Tenderete.</p>
                    <h4 class="font-bold text-gray-900 mt-4 mb-2">Tipos de cookies que utilizamos</h4>
                    <ul class="list-disc pl-5 mb-4 space-y-2">
                        <li><strong>Cookies estrictamente necesarias:</strong> Esenciales para el funcionamiento básico del sitio.</li>
                        <li><strong>Cookies de rendimiento:</strong> Nos permiten analizar el uso del sitio para medir y mejorar su rendimiento.</li>
                        <li><strong>Cookies de funcionalidad:</strong> Permiten que el sitio recuerde tus elecciones (como tu nombre de usuario o el tamaño de letra).</li>
                    </ul>
                </div>
            </div>

            <!-- CONTENIDO SOPORTE -->
            <div x-show="activeTab === 'soporte'" x-transition.opacity.duration.300ms style="display: none;">
                <h3 class="text-xl font-bold text-[#1e293b] border-b pb-2 mb-4">Soporte Técnico</h3>
                <p class="text-gray-700 text-sm mb-6">Si tienes algún problema con la plataforma o necesitas ayuda, por favor rellena el siguiente formulario y nos pondremos en contacto contigo lo antes posible.</p>
                
                <form x-on:submit.prevent="
                    isSubmitting = true;
                    fetch('{{ route('soporte.send') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(soporteForm)
                    })
                    .then(res => res.json().then(data => ({ ok: res.ok, data })))
                    .then(res => {
                        if (!res.ok) throw new Error(res.data.message || 'Error');
                        if(typeof Swal !== 'undefined') {
                            Swal.fire({icon: 'success', title: 'Enviado', text: res.data.message, confirmButtonColor: '#9333ea'});
                        } else {
                            alert(res.data.message);
                        }
                        soporteForm = { name: '', email: 'tenderete2026@gmail.com', message: '' };
                    })
                    .catch(err => {
                        if(typeof Swal !== 'undefined') {
                            Swal.fire({icon: 'error', title: 'Error', text: err.message, confirmButtonColor: '#9333ea'});
                        } else {
                            alert(err.message);
                        }
                    })
                    .finally(() => { isSubmitting = false; });
                " class="flex flex-col gap-4 max-w-lg bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                        <input type="text" x-model="soporteForm.name" required placeholder="Ej: María García" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2" style="outline-color: #a855f7;">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mensaje o Problema</label>
                        <textarea x-model="soporteForm.message" required rows="4" placeholder="Escribe aquí en qué podemos ayudarte..." class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2" style="outline-color: #a855f7;"></textarea>
                    </div>
                    <button type="submit" :disabled="isSubmitting" class="text-white font-bold py-2.5 px-6 rounded-lg mt-2 transition-opacity hover:opacity-90 w-fit shadow-sm disabled:opacity-50" style="background-color: #9333ea;">
                        <span x-text="isSubmitting ? 'Enviando...' : 'Enviar Mensaje'"></span>
                    </button>
                </form>
            </div>

            <!-- CONTENIDO OTROS -->
            <div x-show="activeTab === 'otros'" x-transition.opacity.duration.300ms style="display: none;">
                <h3 class="text-xl font-bold text-[#1e293b] border-b pb-2 mb-4">Otros Términos y Condiciones</h3>
                <div class="prose max-w-none text-gray-700 text-sm">
                    <p class="mb-4">Al utilizar Tenderete, aceptas cumplir con nuestros términos de servicio y normas de la comunidad.</p>
                    <h4 class="font-bold text-gray-900 mt-4 mb-2">Normas Comunitarias</h4>
                    <p class="mb-4">Fomentamos un ambiente de respeto mutuo. No se tolerará el acoso, discurso de odio, o contenido inapropiado en la plataforma.</p>
                    <h4 class="font-bold text-gray-900 mt-4 mb-2">Propiedad Intelectual</h4>
                    <p>El contenido generado por los usuarios en Tenderete sigue siendo propiedad de sus respectivos autores, pero al publicarlo nos otorgas una licencia para mostrarlo en la plataforma.</p>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
