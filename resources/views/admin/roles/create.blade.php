<x-admin-layout title="Roles | GYM Lixie" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
        'href' => route('admin.roles.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">
<x-wireui-card>
    <form action="{{route('admin.roles.store')}}" method="POST">
        
        @csrf

        <x-wireui-input 
        label="Nombre"
        name="name"
        placeholder="Nombre del rol"
        
        value="{{old('name')}}"
        >

        </x-wireui-input>
        
        <div class="flex justify-end mt-4">
            <x-wireui-button type="submit" blue >Guardar</x-wireui-button>
       </div>
    </form>
</x-wireui-card>
</x-admin-layout>