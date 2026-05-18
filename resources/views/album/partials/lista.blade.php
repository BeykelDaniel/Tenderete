@foreach($mis_actividades as $a)
    <a href="{{ route('actividades.album', $a->id) }}" 
       class="actividad-item bg-white rounded-[24px] p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-300 flex flex-col group text-center">
        
        {{-- Área del placeholder / primera foto --}}
        <div class="aspect-[1.6] bg-gray-50 rounded-2xl flex items-center justify-center mb-4 overflow-hidden relative border border-gray-100 group-hover:bg-gray-100/70 transition-colors">
            @php
                $primeraFoto = $a->media->first();
            @endphp
            @if($primeraFoto)
                @if($primeraFoto->tipo === 'video')
                    <video src="{{ asset($primeraFoto->url) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"></video>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="bi bi-play-circle-fill text-white/80 text-4xl"></i>
                    </div>
                @else
                    <img src="{{ asset($primeraFoto->url) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $a->nombre }}">
                @endif
            @else
                <i class="bi bi-images text-5xl text-gray-300 transition-transform duration-300 group-hover:scale-110"></i>
            @endif
        </div>

        {{-- Título del Álbum --}}
        <span class="font-extrabold text-gray-950 text-sm uppercase tracking-wider block truncate group-hover:text-indigo-600 transition-colors">
            {{ $a->nombre }}
        </span>
    </a>
@endforeach

@if($mis_actividades->isEmpty())
    <div class="col-span-full py-12 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
        <i class="bi bi-images text-5xl text-gray-300 mb-4 block"></i>
        <p class="text-gray-500 font-black italic uppercase text-sm tracking-widest">Aún no tienes álbumes de actividades</p>
    </div>
@endif
