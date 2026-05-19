@extends('layout')

@section('title', 'Panel de Administración')

@section('contenido')
<div class="min-h-screen p-4 font-sans flex flex-col items-center gap-6 rounded-2xl max-w-[1200px] mx-auto">

    <div class="w-full bg-white rounded-xl p-6 shadow-sm mb-4">
        <h2 class="text-3xl font-black text-gray-800 uppercase flex items-center gap-3 border-b-4 border-indigo-100 pb-4">
            <i class="bi bi-shield-lock-fill text-indigo-600"></i>
            Panel de Control del Administrador
        </h2>
        <p class="mt-4 text-gray-600 italic">Bienvenido al área de gestión centralizada. Aquí puedes moderar usuarios y contenido multimedia para garantizar el cumplimiento del RGPD y mantener el servidor limpio.</p>
    </div>

    {{-- GESTIÓN DE USUARIOS --}}
    <section class="w-full bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-xl font-bold text-gray-800 uppercase flex items-center gap-2 mb-6 border-b pb-2">
            <i class="bi bi-people-fill text-[#bc6a50]"></i> Gestión de Usuarios y Comunidades
        </h3>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider">
                        <th class="p-4 rounded-tl-lg">ID</th>
                        <th class="p-4">Nombre</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Registro</th>
                        <th class="p-4 text-right rounded-tr-lg">Acción (Cascada)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($usuarios as $u)
                    <tr class="hover:bg-indigo-50 transition-colors group">
                        <td class="p-4 font-bold text-gray-500">#{{ $u->id }}</td>
                        <td class="p-4 font-bold text-gray-800 flex items-center gap-3">
                            @if($u->perfil_foto)
                                <img src="/{{ $u->perfil_foto }}" class="w-8 h-8 rounded-full object-cover shadow-sm">
                            @else
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-xs">👤</div>
                            @endif
                            {{ $u->name }}
                        </td>
                        <td class="p-4 text-gray-600">{{ $u->email }}</td>
                        <td class="p-4 text-gray-500 text-sm">{{ $u->created_at->format('d/m/Y') }}</td>
                        <td class="p-4 text-right">
                            @if($u->email !== 'cabrerajosedaniel89@gmail.com')
                                <form action="{{ route('admin.usuarios.destroy', $u->id) }}" method="POST" onsubmit="return confirm('ATENCIÓN: Esto borrará al usuario, todas sus fotos, actividades e inscripciones para cumplir con el RGPD. ¿Estás absolutamente seguro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-4 py-2 rounded-lg font-bold text-xs uppercase tracking-wider transition-all border border-red-200 hover:border-red-600">
                                        <i class="bi bi-trash3-fill"></i> Borrar
                                    </button>
                                </form>
                            @else
                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg font-bold text-xs uppercase">Admin</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- GESTIÓN MULTIMEDIA --}}
    <section class="w-full bg-white rounded-xl p-6 shadow-sm mt-4">
        <h3 class="text-xl font-bold text-gray-800 uppercase flex items-center gap-2 mb-2 border-b pb-2">
            <i class="bi bi-images text-[#bc6a50]"></i> Modulación de Imágenes (Álbumes)
        </h3>
        <p class="text-sm font-bold text-indigo-600 uppercase mb-6 tracking-widest bg-indigo-50 p-3 rounded-lg inline-block">Archivos Físicos en Servidor: {{ $archivosValidos->count() }}</p>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($multimedia as $m)
                @php
                    $existe = file_exists(public_path($m->url));
                @endphp
                <div class="relative bg-gray-50 rounded-xl border border-gray-200 overflow-hidden group shadow-sm flex flex-col justify-between h-full">
                    <div class="aspect-square w-full bg-gray-200 relative">
                        @if($existe)
                            @if($m->tipo === 'video')
                                <video class="w-full h-full object-cover" muted>
                                    <source src="/{{ $m->url }}">
                                </video>
                                <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                    <i class="bi bi-play-circle-fill text-white text-3xl"></i>
                                </div>
                            @else
                                <img src="/{{ $m->url }}" class="w-full h-full object-cover">
                            @endif
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-red-400 bg-red-50 p-2 text-center">
                                <i class="bi bi-exclamation-triangle-fill text-2xl mb-1"></i>
                                <span class="text-[10px] font-bold uppercase">Huérfano<br>(No en disco)</span>
                            </div>
                        @endif
                        
                        {{-- Overlay de Borrado --}}
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                            <form action="{{ route('admin.media.destroy', $m->id) }}" method="POST" onsubmit="return confirm('¿Borrar definitivamente este archivo físico del servidor?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-red-700 hover:scale-110 transition-all shadow-xl">
                                    <i class="bi bi-trash3-fill text-xl"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="p-2 text-center bg-white border-t border-gray-100">
                        <p class="text-[10px] text-gray-500 font-bold uppercase truncate" title="Subido por: {{ $m->userName ?? 'Desconocido' }}">👤 {{ $m->userName ?? '?' }}</p>
                        <p class="text-[9px] text-indigo-400 font-bold uppercase truncate mt-0.5" title="Actividad: {{ $m->actividadTitulo ?? 'Desconocida' }}">📅 {{ Str::limit($m->actividadTitulo ?? '?', 15) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($multimedia->isEmpty())
            <div class="text-center py-10 text-gray-400 italic">No hay archivos multimedia subidos en la plataforma.</div>
        @endif
    </section>

    {{-- MODERACIÓN DE FOROS E INSCRIPCIONES --}}
    <section class="w-full bg-white rounded-xl p-6 shadow-sm mt-4">
        <h3 class="text-xl font-bold text-gray-800 uppercase flex items-center gap-2 mb-6 border-b pb-2">
            <i class="bi bi-chat-text-fill text-[#bc6a50]"></i> Moderación de Foros e Inscripciones
        </h3>
        <p class="text-gray-600 mb-4 text-sm">Control centralizado de debates activos e inscripciones. Puedes suspender foros o revisar reportes comunitarios.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="border border-gray-200 p-4 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-bold text-gray-800">Foro: Taller de Pintura</h4>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded font-bold">Limpio</span>
                </div>
                <p class="text-sm text-gray-500">8 mensajes recientes. 5 inscritos.</p>
                <div class="mt-4 flex gap-2">
                    <button class="text-xs bg-indigo-50 text-indigo-600 px-3 py-1 border border-indigo-200 rounded hover:bg-indigo-600 hover:text-white transition">Ver Mensajes</button>
                    <button class="text-xs bg-gray-50 text-gray-600 px-3 py-1 border border-gray-200 rounded hover:bg-gray-200 transition">Ver Inscritos</button>
                </div>
            </div>
            <div class="border border-gray-200 p-4 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-bold text-gray-800">Foro: Caminata Matutina</h4>
                    <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded font-bold">1 Reporte</span>
                </div>
                <p class="text-sm text-gray-500">24 mensajes recientes. 12 inscritos.</p>
                <div class="mt-4 flex gap-2">
                    <button class="text-xs bg-red-50 text-red-600 px-3 py-1 border border-red-200 rounded hover:bg-red-600 hover:text-white transition">Bloquear Foro</button>
                    <button class="text-xs bg-indigo-50 text-indigo-600 px-3 py-1 border border-indigo-200 rounded hover:bg-indigo-600 hover:text-white transition">Moderar Mensajes</button>
                </div>
            </div>
        </div>
    </section>

    {{-- SOPORTE TÉCNICO --}}
    <section class="w-full bg-white rounded-xl p-6 shadow-sm mt-4">
        <h3 class="text-xl font-bold text-gray-800 uppercase flex items-center gap-2 mb-6 border-b pb-2">
            <i class="bi bi-headset text-[#bc6a50]"></i> Soporte Técnico y Resoluciones
        </h3>
        <p class="text-gray-600 mb-4 text-sm">Soporte técnico conectado para ayudar a usuarios con incidencias de la plataforma.</p>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider">
                        <th class="p-4 rounded-tl-lg">Ticket</th>
                        <th class="p-4">Usuario</th>
                        <th class="p-4">Asunto / Incidencia</th>
                        <th class="p-4">Estado</th>
                        <th class="p-4 text-right rounded-tr-lg">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-indigo-50 transition-colors group">
                        <td class="p-4 font-bold text-gray-500">#TK-892</td>
                        <td class="p-4 font-bold text-gray-800 flex items-center gap-2"><i class="bi bi-person-circle text-gray-400"></i> María López</td>
                        <td class="p-4 text-gray-600">Problemas para subir foto al álbum, se queda cargando.</td>
                        <td class="p-4"><span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg font-bold text-xs uppercase shadow-sm">Pendiente</span></td>
                        <td class="p-4 text-right">
                            <button class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-lg font-bold text-xs uppercase hover:bg-indigo-600 hover:text-white transition border border-indigo-200">Responder</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-indigo-50 transition-colors group">
                        <td class="p-4 font-bold text-gray-500">#TK-891</td>
                        <td class="p-4 font-bold text-gray-800 flex items-center gap-2"><i class="bi bi-person-circle text-gray-400"></i> Carlos Pérez</td>
                        <td class="p-4 text-gray-600">Duda sobre privacidad en foros de comunidades.</td>
                        <td class="p-4"><span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg font-bold text-xs uppercase shadow-sm">Resuelto</span></td>
                        <td class="p-4 text-right">
                            <button class="bg-gray-50 text-gray-600 px-4 py-2 rounded-lg font-bold text-xs uppercase border border-gray-200 hover:bg-gray-200 transition">Ver Historial</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</div>
@endsection
