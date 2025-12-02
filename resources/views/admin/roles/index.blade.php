<x-admin-layout title="Roles | GYM Lixie" :breadcrumbs="[

    ['name' => 'Dashboard',
        'href' => route('admin.dashboard')
        ],

    ['name' => 'Roles'
    
    ],
    
    ]">
<x-slot name="action">
    
    <x-wireui-button blue href="{{ route('admin.roles.create') }}" >
       
        <i class="fa-solid fa-plus text-sm"></i>
        Nuevo
    
</x-wireui-button>

   </x-slot>

    @livewire('admin.datatables.role-table')

    
</x-admin-layout>