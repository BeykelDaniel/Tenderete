<x-app-layout>
<div class="min-h-screen bg-gray-50 flex flex-col md:flex-row">

    <!-- Menú Lateral Izquierdo (Mismo diseño que Tenderete) -->
    <div class="w-full md:w-64 flex-shrink-0 relative z-50">
        @include('navbar')
    </div>

    <!-- Contenido Principal -->
    <div class="flex-1 p-8 pt-24 md:pt-8 w-full transition-all duration-300 relative z-10 md:ml-0 overflow-x-hidden">
        
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-black text-[#32424D] flex items-center gap-3">
                    <i class="bi bi-shield-lock-fill text-red-600"></i> Panel de Administración
                </h1>
                <a href="{{ route('pagina.inicio') }}" class="bg-[#bc6a50] text-white px-4 py-2 rounded-xl font-bold shadow-md hover:bg-[#a55a42] transition">
                    Volver a Inicio
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow" role="alert">
                    <p class="font-bold">¡Éxito!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow" role="alert">
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Tarjetas de Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-[#bc6a50]">
                    <h2 class="text-xl font-bold text-gray-700 mb-2">Total Usuarios Registrados</h2>
                    <p class="text-4xl font-black text-[#bc6a50]">{{ $usuarios->count() }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-[#D4B830]">
                    <h2 class="text-xl font-bold text-gray-700 mb-2">Total Archivos (Álbumes)</h2>
                    <p class="text-4xl font-black text-[#D4B830]">{{ $media->count() }}</p>
                </div>
            </div>

            <!-- TABLA DE USUARIOS (RGPD) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-people-fill text-[#32424D]"></i> Gestión de Usuarios y Comunidades (RGPD)
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Actividades Creadas</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($usuarios as $u)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            {{-- Consultar --}}
                                            <a href="{{ route('usuarios.show', $u) }}"
                                                class="text-blue-600 hover:text-blue-900" title="Ver detalles">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            {{-- Editar --}}
                                            <a href="{{ route('usuarios.edit', $u) }}"
                                                class="text-green-600 hover:text-green-900" title="Editar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            {{-- Eliminar --}}
                                            @if($u->id !== Auth::id())
                                            <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('ATENCIÓN: Se aplicará Borrado en Cascada (RGPD). Se borrarán sus fotos, mensajes, foros, inscripciones y el usuario entero de forma permanente. ¿Estás absolutamente seguro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar Usuario">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">#{{ $u->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                                        <div class="flex items-center gap-3">
                                            @if($u->perfil_foto)
                                                <img src="{{ asset($u->perfil_foto) }}" class="w-8 h-8 rounded-full object-cover shadow-sm">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            @endif
                                            <span class="font-bold text-gray-700">{{ $u->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $u->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded-full">
                                            {{ $u->actividades_count }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TABLA DE MEDIA (MODERACIÓN) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-images text-[#bc6a50]"></i> Moderación de Álbumes (Limpieza Disco Duro)
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Actividad</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Estado Disco</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($media as $m)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            {{-- Consultar --}}
                                            <a href="{{ asset($m->url) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-900" title="Ver archivo">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            {{-- Eliminar --}}
                                            <form action="{{ route('fotos.destroy', $m->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('¿Borrar definitivamente este archivo físico?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar Archivo">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($m->existe)
                                            @if($m->tipo == 'video')
                                                <div class="w-16 h-16 bg-gray-200 rounded-xl flex items-center justify-center text-gray-500 shadow-sm"><i class="bi bi-play-circle text-2xl"></i></div>
                                            @else
                                                <img src="{{ asset($m->url) }}" class="w-16 h-16 object-cover rounded-xl shadow-sm">
                                            @endif
                                        @else
                                            <div class="w-16 h-16 bg-red-50 rounded-xl flex items-center justify-center text-red-500 shadow-sm font-bold text-xs text-center border border-red-200">Roto<br>(404)</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <div class="font-bold text-gray-700">{{ $m->autor }}</div>
                                        <div class="text-xs text-gray-500">{{ $m->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $m->actividad }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        @if($m->existe)
                                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-full"><i class="bi bi-check-circle"></i> Físico OK</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-1 rounded-full"><i class="bi bi-x-circle"></i> Perdido (Volátil)</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 font-bold">No hay archivos multimedia subidos.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</x-app-layout>
