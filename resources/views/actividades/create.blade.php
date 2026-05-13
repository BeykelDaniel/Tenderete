@extends('layout')

@section('title', $oper == 'create' ? 'Crear Actividad - Tenderete' : 'Editar Actividad')

@section('contenido')
<div class="max-w-4xl mx-auto py-6 px-4">
    <div class="bg-white rounded-[20px] shadow-2xl overflow-hidden border-4 border-[#32424D]/10">
        
        {{-- CABECERA CÁLIDA --}}
        <div class="bg-[#bc6a50] p-4 md:p-6 text-white flex flex-col md:flex-row items-start md:items-center justify-between gap-2">
            <div>
                <h1 class="text-xl md:text-2xl font-black uppercase tracking-tight mb-1">
                    {{ $oper == 'create' ? 'Nueva Actividad' : 'Modificar Actividad' }}
                </h1>
                <p class="text-sm md:text-base font-bold opacity-80 italic">Cuéntanos qué plan tienes en mente para hoy.</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-md self-end md:self-auto hidden md:flex">
                <i class="bi bi-calendar-plus text-xl md:text-2xl"></i>
            </div>
        </div>

        <div class="p-4 md:p-6">
            @if (session('success'))
                <div class="text-center py-10">
                    <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner animate-bounce">
                        <i class="bi bi-check-lg text-6xl"></i>
                    </div>
                    <h3 class="text-3xl font-black text-[#32424D] uppercase mb-4">{{ session('success') }}</h3>
                    <p class="text-xl text-gray-400 font-bold mb-10 leading-relaxed italic">¡Genial! La actividad ya está publicada y los demás podrán verla.</p>
                    <a href="{{ route('pagina.inicio') }}" class="inline-block bg-[#32424D] text-white font-black py-5 px-12 rounded-3xl shadow-xl hover:scale-105 transition-transform uppercase tracking-widest text-lg">
                        <i class="bi bi-house-door-fill mr-4"></i> Volver al Inicio
                    </a>
                </div>
            @else
                
                @if ($errors->any())
                    <div class="mb-10 p-6 bg-red-50 border-l-8 border-red-500 rounded-2xl">
                        <p class="text-lg font-black text-red-800 uppercase mb-2">Por favor, revisa esto:</p>
                        <ul class="list-disc ml-6 text-red-700 font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ $oper == 'create' ? route('actividades.store') : route('actividades.update', $actividad->id) }}"
                      method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if($oper == 'edit') @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        @php
                            $inputClasses = "w-full p-3 md:p-4 bg-gray-50 border-2 border-gray-100 rounded-xl focus:bg-white focus:border-[#bc6a50] focus:ring-4 focus:ring-[#bc6a50]/10 outline-none transition-all text-sm md:text-base font-bold";
                            $labelClasses = "block text-xs font-black text-gray-400 uppercase tracking-widest ml-2 mb-1";
                        @endphp



                        {{-- 1. NOMBRE --}}
                        <div class="col-span-full">
                            <label class="{{ $labelClasses }}">¿Cómo se llama la actividad?</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $actividad->nombre ?? '') }}"
                                   class="{{ $inputClasses }}" {{ $oper=='show' ? 'disabled' : 'required' }}
                                   placeholder="Ej. Taller de Cerámica o Paseo por el Retiro">
                        </div>

                        {{-- 2. DESCRIPCIÓN --}}
                        <div class="col-span-full">
                            <label class="{{ $labelClasses }}">Cuéntanos un poco más</label>
                            <textarea name="descripcion" rows="2" class="{{ $inputClasses }}" {{ $oper=='show' ? 'disabled' : 'required' }}
                                      placeholder="Escribe aquí de qué trata el plan...">{{ old('descripcion', $actividad->descripcion ?? '') }}</textarea>
                        </div>

                        {{-- 3. FECHA --}}
                        <div class="space-y-2">
                            <label class="{{ $labelClasses }}">¿Qué día es?</label>
                            <input type="date" name="fecha"
                                   value="{{ old('fecha', isset($actividad->fecha) ? \Carbon\Carbon::parse($actividad->fecha)->format('Y-m-d') : '') }}"
                                   class="{{ $inputClasses }}" {{ $oper=='show' ? 'disabled' : 'required' }}>
                        </div>

                        {{-- 4. HORA --}}
                        <div class="space-y-2">
                            <label class="{{ $labelClasses }}">¿A qué hora empieza?</label>
                            <input type="time" name="hora" value="{{ old('hora', $actividad->hora ?? '') }}"
                                   class="{{ $inputClasses }}" {{ $oper=='show' ? 'disabled' : 'required' }}>
                        </div>

                        {{-- 5. LUGAR --}}
                        <div class="col-span-full">
                            <label class="{{ $labelClasses }}">¿Dónde nos vemos?</label>
                            <input type="text" name="lugar" value="{{ old('lugar', $actividad->lugar ?? '') }}"
                                   class="{{ $inputClasses }}" {{ $oper=='show' ? 'disabled' : 'required' }}
                                   placeholder="Ej. Centro Cultural, Parque, Plaza...">
                        </div>

                        <div class="space-y-2">
                            <label class="{{ $labelClasses }}">Precio (€)</label>
                            <input type="number" step="0.01" name="precio" value="{{ old('precio', $actividad->precio ?? '0.00') }}"
                                   class="{{ $inputClasses }}" placeholder="0.00" {{ $oper=='show' ? 'disabled' : '' }}>
                        </div>

                        <div class="space-y-2">
                            <label class="{{ $labelClasses }}">Cupos (Plazas)</label>
                            <input type="number" name="cupos" value="{{ old('cupos', $actividad->cupos ?? '50') }}"
                                   class="{{ $inputClasses }}" placeholder="Ej. 20" {{ $oper=='show' ? 'disabled' : '' }}>
                        </div>
                    </div>

                    {{-- BOTONES FINALES --}}
                    <div class="mt-6 md:mt-8 flex flex-col md:flex-row gap-3 pt-4 md:pt-6 border-t-4 border-gray-50">
                        <button type="submit" class="flex-1 bg-[#bc6a50] text-white font-black py-3 md:py-4 rounded-xl shadow-lg hover:bg-[#8e4f3c] hover:scale-[1.02] active:scale-95 transition-all uppercase tracking-widest text-base md:text-lg">
                            {{ $oper == 'create' ? 'Crear Actividad Ahora' : 'Guardar Cambios' }}
                        </button>
                        <a href="{{ route('pagina.inicio') }}" class="px-6 md:px-10 py-3 md:py-4 bg-gray-100 text-gray-400 font-black rounded-xl hover:bg-gray-200 transition-all uppercase tracking-widest text-center text-sm md:text-base">
                            Cancelar
                        </a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection