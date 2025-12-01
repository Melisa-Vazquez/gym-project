@props([
    'title' => config('app.name', 'Laravel'),
    'breadcrumbs' => [],
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/c23eec2327.js" crossorigin="anonymous"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- WireUI -->
    @wireUiStyles
    @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-200">
        @include('layouts.includes.admin.navigation')
        @include('layouts.includes.admin.sidebar')

        <div class="p-4 sm:ml-64">
            <!-- Añadir margen superior -->
            <div class="mt-14 flex items-center justify-between w-full">
                @include('layouts.includes.admin.breadcrumb', ['breadcrumbs' => $breadcrumbs])

                {{-- Aquí renderizamos el botón NUEVO --}}
                {{ $action ?? '' }}
            </div>

            {{ $slot }}
        </div>

            @stack('modals')
    @livewireScripts
    @wireUiScripts
        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        @if (session('swal'))
            <script>
                Swal.fire(@json(session('swal')));
            </script>
        @endif

        <script>
            // Buscar todos los formularios con clase "delete-form"
            const forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                // Escuchar el evento submit
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Evitar envío inmediato

                    Swal.fire({
                        title: '¿Está seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Enviar si se confirma
                        }
                    });
                });
            });
        </script>
    </body>
</html>