@extends('layouts.app')

@section('content')
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
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
                <div class="bg-[#32424D] p-4 text-white">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <i class="bi bi-people-fill"></i> Gestión de Usuarios y Comunidades (RGPD)
                    </h2>
                    <p class="text-sm opacity-80 mt-1">Borrado en cascada: Elimina usuario, fotos, actividades e inscripciones.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200 text-gray-600 text-sm uppercase">
                                <th class="p-4 font-bold">ID</th>
                                <th class="p-4 font-bold">Nombre</th>
                                <th class="p-4 font-bold">Email</th>
                                <th class="p-4 font-bold">Actividades Creadas</th>
                                <th class="p-4 font-bold text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $u)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-500">#{{ $u->id }}</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        @if($u->perfil_foto)
                                            <img src="{{ asset($u->perfil_foto) }}" class="w-8 h-8 rounded-full object-cover">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        @endif
                                        <span class="font-bold text-gray-700">{{ $u->name }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-gray-600">{{ $u->email }}</td>
                                <td class="p-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded-full">
                                        {{ $u->actividades_count }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    @if($u->id !== Auth::id())
                                    <form action="{{ route('admin.user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('ATENCIÓN: Se aplicará Borrado en Cascada (RGPD). Se borrarán sus fotos, mensajes, foros, inscripciones y el usuario entero de forma permanente. ¿Estás absolutamente seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-lg text-sm font-bold shadow transition flex items-center gap-1 mx-auto">
                                            <i class="bi bi-trash-fill"></i> Eliminar Usuario
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-xs font-bold text-gray-400">Administrador actual</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TABLA DE MEDIA (MODERACIÓN) -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-[#bc6a50] p-4 text-white">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <i class="bi bi-images"></i> Moderación de Álbumes (Limpieza Disco Duro)
                    </h2>
                    <p class="text-sm opacity-80 mt-1">Borrado físico del disco de Railway y de la base de datos.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200 text-gray-600 text-sm uppercase">
                                <th class="p-4 font-bold w-24">Preview</th>
                                <th class="p-4 font-bold">Autor</th>
                                <th class="p-4 font-bold">Actividad</th>
                                <th class="p-4 font-bold">Estado Disco</th>
                                <th class="p-4 font-bold text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($media as $m)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="p-4">
                                    @if($m->existe)
                                        @if($m->tipo == 'video')
                                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-500 shadow"><i class="bi bi-play-circle text-2xl"></i></div>
                                        @else
                                            <img src="{{ asset($m->url) }}" class="w-16 h-16 object-cover rounded shadow">
                                        @endif
                                    @else
                                        <div class="w-16 h-16 bg-red-100 rounded flex items-center justify-center text-red-500 shadow font-bold text-xs text-center border border-red-300">Roto<br>(404)</div>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-700">{{ $m->autor }}</div>
                                    <div class="text-xs text-gray-500">{{ $m->email }}</div>
                                </td>
                                <td class="p-4 text-sm font-semibold text-gray-600">{{ $m->actividad }}</td>
                                <td class="p-4">
                                    @if($m->existe)
                                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full"><i class="bi bi-check-circle"></i> Físico OK</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded-full"><i class="bi bi-x-circle"></i> Perdido (Volátil)</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.media.destroy', $m->id) }}" method="POST" onsubmit="return confirm('¿Borrar definitivamente este archivo físico?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-lg text-sm font-bold shadow transition flex items-center gap-1 mx-auto">
                                            <i class="bi bi-trash-fill"></i> Borrar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500 font-bold">No hay archivos multimedia subidos.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
