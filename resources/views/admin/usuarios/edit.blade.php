<x-admin-layout 
    title="Usuarios | Editar | Healthify"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Usuarios',
            'href' => route('admin.usuarios.index'),
        ],
        [
            'name' => 'Editar',
        ],
    ]"
>

    <x-wireui-card>

        <form action="{{ route('admin.usuarios.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <x-wireui-input 
                label="Nombre Completo"
                name="name"
                placeholder="Nombre completo"
                value="{{ old('name', $user->name) }}"
                required
            />

            {{-- Email --}}
            <x-wireui-input 
                label="Correo Electrónico"
                name="email"
                type="email"
                placeholder="correo@ejemplo.com"
                value="{{ old('email', $user->email) }}"
                class="mt-4"
                required
            />

            {{-- Teléfono --}}
            <x-wireui-input 
                label="Teléfono"
                name="phone"
                placeholder="999 999 9999"
                value="{{ old('phone', $user->phone) }}"
                class="mt-4"
            />

            {{-- Dirección --}}
            <x-wireui-input 
                label="Dirección"
                name="address"
                placeholder="Calle, colonia, ciudad"
                value="{{ old('address', $user->address) }}"
                class="mt-4"
            />

            {{-- Rol --}}
            <x-wireui-select
                label="Rol"
                name="role"
                placeholder="Selecciona un rol"
                :options="$roles"
                option-label="name"
                option-value="name"
                :selected="$user->getRoleNames()->first()"
                class="mt-4"
                required
            />

            <div class="flex justify-end mt-6">
                <x-wireui-button type="submit" blue icon="pencil-square" class="font-semibold">
                    Actualizar Usuario
                </x-wireui-button>
            </div>

        </form>

    </x-wireui-card>

</x-admin-layout>
