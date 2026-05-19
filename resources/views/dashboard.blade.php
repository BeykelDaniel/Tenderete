<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(Auth::check() && Auth::user()->email === 'cabrerajosedaniel89@gmail.com')
                <!-- Sección para Administradores -->
                <div class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-150 dark:border-gray-700">
                    <div class="p-8 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="p-2 bg-red-100 text-red-600 rounded-lg dark:bg-red-950 dark:text-red-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <h3 class="text-2xl font-black text-gray-800 dark:text-white">Panel de Administración</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-2xl">Bienvenido al centro de control de Tenderete. Desde aquí tienes acceso total para supervisar y mantener los recursos de la comunidad de forma segura.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            
                            <!-- Tarjeta de Usuarios -->
                            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100/50 dark:from-indigo-950/30 dark:to-indigo-900/10 border border-indigo-200/60 dark:border-indigo-800/60 p-6 rounded-2xl shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="p-3 bg-indigo-500 text-white rounded-xl shadow-md">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Usuarios</span>
                                </div>
                                <h4 class="text-lg font-black text-gray-800 dark:text-white mb-2">Gestionar Usuarios</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Ver el listado completo de usuarios, dar de alta nuevos amigos, modificar perfiles o gestionar bajas.</p>
                                <a href="{{ route('usuarios.index') }}" class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 font-bold transition text-sm">
                                    Acceder <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            <!-- Tarjeta de Actividades -->
                            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 dark:from-emerald-950/30 dark:to-emerald-900/10 border border-emerald-200/60 dark:border-emerald-800/60 p-6 rounded-2xl shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="p-3 bg-emerald-500 text-white rounded-xl shadow-md">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Actividades</span>
                                </div>
                                <h4 class="text-lg font-black text-gray-800 dark:text-white mb-2">Gestionar Actividades</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Administrar el calendario de eventos comunitarios, crear actividades grupales o editar cupos.</p>
                                <a href="{{ route('actividades.index') }}" class="inline-flex items-center gap-2 text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 font-bold transition text-sm">
                                    Acceder <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            <!-- Tarjeta de Fotos/Media -->
                            <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 dark:from-amber-950/30 dark:to-amber-900/10 border border-amber-200/60 dark:border-amber-800/60 p-6 rounded-2xl shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="p-3 bg-amber-500 text-white rounded-xl shadow-md">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Multimedia</span>
                                </div>
                                <h4 class="text-lg font-black text-gray-800 dark:text-white mb-2">Moderación de Fotos</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Supervisar y liberar espacio en disco eliminando archivos multimedia obsoletos o rotos.</p>
                                <a href="{{ route('fotos.index') }}" class="inline-flex items-center gap-2 text-amber-600 dark:text-amber-400 hover:text-amber-800 font-bold transition text-sm">
                                    Acceder <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-150 dark:border-gray-700">
                <div class="p-8 text-gray-900 dark:text-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-lg font-black">¡Bienvenido de nuevo, {{ Auth::user()->name }}!</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Has iniciado sesión correctamente en Tenderete.</p>
                    </div>
                    <div class="h-12 w-12 bg-blue-50 dark:bg-blue-950/40 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 font-black">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
