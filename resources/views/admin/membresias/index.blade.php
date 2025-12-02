<x-admin-layout title="Usuarios | GYM Lixie" :breadcrumbs="[

    ['name' => 'Dashboard',
        'href' => route('admin.dashboard')
        ],

    ['name' => 'Membresías'
    
    ],
    
    ]">
<x-slot name="action">
    
    <x-wireui-button blue href="{{ route('admin.membresias.create') }}" >
       
        <i class="fa-solid fa-plus text-sm"></i>
        Nuevo
    
</x-wireui-button>

   </x-slot>

  @livewire('admin.datatables.membresia-table')

    
</x-admin-layout>