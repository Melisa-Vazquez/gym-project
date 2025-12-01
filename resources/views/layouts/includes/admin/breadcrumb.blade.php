{{-- Verificar si hay elementos en breadcrumbs --}}
@if(count($breadcrumbs))
    {{-- Margin bottom --}}
    <nav class="mb-2 block">
        <ol class="flex flex-wrap text-slate-700 text-sm">
            {{-- Recorrer elementos de breadcrumb --}}
            @foreach ($breadcrumbs as $item)
                <li class="flex items-center">
                    {{-- Si no es el primer elemento, ponle separador --}}
                    @unless($loop->first)
                        <span class="px-2 text-gray-400">/</span>
                    @endunless

                    {{-- Revisar si tiene un href --}}
                    @isset($item['href'])
                        <a href="{{ $item['href'] }}" class="opacity-60 hover:opacity-100 transition">
                            {{ $item['name'] }}
                        </a>
                    @else
                        {{ $item['name'] }}
                    @endisset
                </li>
            @endforeach
        </ol>

        {{-- Validar si hay más de un elemento y mostrar el último en negritas --}}
        @if (count($breadcrumbs) > 1)
            <h6 class="font-bold mt-2">
                {{ end($breadcrumbs)['name'] }}
            </h6>
        @endif
    </nav>
@endif
