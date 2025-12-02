<x-admin-layout title="Usuarios | GYM Lixie" :breadcrumbs="[

    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],

    [
        'name' => 'Usuarios'
    ],

]">

    <x-slot name="action">
        <x-wireui-button blue href="{{ route('admin.usuarios.create') }}">
            <i class="fa-solid fa-plus text-sm"></i>
            Nuevo
        </x-wireui-button>
    </x-slot>

    @livewire('admin.datatables.user-table')

</x-admin-layout>
