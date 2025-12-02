<x-admin-layout title="Roles | lovemedic" :breadcrumbs="[

    ['name' => 'Dashboard',
        'href' => route('admin.dashboard')
        ],
    ['name' => 'Roles',
    'href' => route('admin.roles.index')
    ],

    ['name' => 'Editar'
    ],
    
    ]">

    <x-wireui-card>
    <form action="{{ route('admin.roles.update', $role )}}" method="POST">
        
        @csrf
        @method('PUT')

        <x-wireui-input 
        label="Nombre"
        name="name"
        placeholder="Nombre del rol"
        
        value="{{ old('name', $role->name) }}"
        >

        </x-wireui-input>
        
        <div class="flex justify-end mt-4">
            <x-wireui-button type="submit" blue >Actualizar</x-wireui-button>
    </div>
    </form>
</x-wireui-card>

    
</x-admin-layout>