@foreach($mis_actividades as $a)
    <div class="actividad-item p-4 rounded-xl border-2 border-gray-50 flex items-center gap-4 hover:border-[#82aeb4] transition-all bg-white shadow-sm group">
        
        <div class="h-20 w-20 overflow-hidden rounded-lg shrink-0 shadow-inner">
            <img src="{{ asset($a->imagen) }}" alt="{{ $a->nombre }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex flex-col">
                <span class="font-black text-gray-900 text-lg uppercase leading-tight truncate">{{ $a->nombre }}</span>
                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest italic mt-1">
                    <i class="bi bi-geo-fill text-[#bc6a50]"></i> {{ $a->lugar }}
                </span>
            </div>
        </div>

        <div class="shrink-0 flex items-center gap-2">
            <a href="{{ route('actividades.album', $a->id) }}" 
               class="bg-[#82aeb4] text-white p-3 rounded-xl hover:bg-[#32424D] transition-colors shadow-md flex items-center justify-center group-hover:shadow-[#82aeb4]/20"
               title="Ver álbum de fotos">
                <i class="bi bi-images text-xl"></i>
            </a>
        </div>
    </div>
@endforeach

@if($mis_actividades->isEmpty())
    <div class="col-span-full py-8 text-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
        <i class="bi bi-journal-album text-4xl text-gray-300 mb-2 block"></i>
        <p class="text-gray-400 font-bold italic uppercase text-xs tracking-widest">Aún no tienes álbumes de actividades</p>
    </div>
@endif
