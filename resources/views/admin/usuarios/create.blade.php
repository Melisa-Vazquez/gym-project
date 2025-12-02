<x-admin-layout title="Usuarios | Crear Nuevo | GYM Lixie" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'href' => route('admin.usuarios.index'),   {{-- CORREGIDO --}}
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <x-wireui-card>
        {{-- Formulario para almacenar un nuevo usuario --}}
        <form action="{{ route('admin.usuarios.store') }}" method="POST"> {{-- CORREGIDO --}}
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nombre --}}
                <x-wireui-input 
                    label="Nombre Completo"
                    name="name"
                    placeholder="Nombre completo"
                    value="{{ old('name') }}"
                    required
                />

                {{-- Email --}}
                <x-wireui-input 
                    label="Correo Electrónico"
                    name="email"
                    type="email"
                    placeholder="correo@ejemplo.com"
                    value="{{ old('email') }}"
                    required
                />
                
                {{-- Número de identificación --}}
                <x-wireui-input 
                    label="Número de identificación"
                    name="id_number"
                    placeholder="ID o CURP"
                    value="{{ old('id_number') }}"
                />

                {{-- Teléfono --}}
                <x-wireui-input 
                    label="Teléfono"
                    name="phone"
                    placeholder="999 999 9999"
                    value="{{ old('phone') }}"
                />

                {{-- Dirección --}}
                <div class="md:col-span-2">
                    <x-wireui-input 
                        label="Dirección"
                        name="address"
                        placeholder="Calle, colonia, ciudad"
                        value="{{ old('address') }}"
                    />
                </div>

                {{-- Contraseña --}}
                <x-wireui-input 
                    label="Contraseña"
                    name="password"
                    type="password"
                    placeholder="********"
                    required
                />

                {{-- Confirmar Contraseña --}}
                <x-wireui-input 
                    label="Confirmar Contraseña"
                    name="password_confirmation"
                    type="password"
                    placeholder="********"
                    required
                />

                {{-- Rol --}}
                <div class="md:col-span-2">
                    <x-wireui-select
                        label="Rol"
                        name="role"
                        placeholder="Selecciona un rol"
                        :options="$roles"       {{-- Asegúrate que el controlador envía $roles --}}
                        option-label="name"
                        option-value="name"
                        required
                    />
                    <p class="text-sm text-gray-500 mt-1">
                        Se recomienda asignar un solo rol al momento de la creación.
                    </p>
                </div>

            </div>

            <div class="flex justify-end mt-6">
                <x-wireui-button type="submit" primary icon="user-plus" class="font-semibold">
                    Guardar Nuevo Usuario
                </x-wireui-button>
            </div>
        </form>
    </x-wireui-card>

</x-admin-layout>
