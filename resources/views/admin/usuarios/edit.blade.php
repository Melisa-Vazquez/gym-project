<x-admin-layout 
    title="Usuarios | Editar | GYM Lixie"
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

        <form action="{{ route('admin.usuarios.update', ['usuario' => $user->id]) }}" method="POST">

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
            
            {{-- ID Number (Agregado para completar los campos comunes de usuario) --}}
            <x-wireui-input 
                label="Número de Identificación"
                name="id_number"
                placeholder="Identificación / Cédula"
                value="{{ old('id_number', $user->id_number) }}"
                class="mt-4"
            />

            {{-- Rol (CON LA CORRECCIÓN DE PRESELECCIÓN) --}}
            <x-wireui-select
                label="Rol"
                name="role"
                placeholder="Selecciona un rol"
                :options="$roles->map(fn($role) => [
                    'value' => $role->name,
                    'name' => $role->name
                ])->values()"
                option-label="name"
                option-value="value"
                {{-- 🔑 Esto asegura que el rol actual del usuario ($roleName) se cargue --}}
                :value="old('role', $roleName)" 
                class="mt-4"
                required
            />

            <h3 class="text-xl font-semibold mt-6 mb-2 border-t pt-4">Cambiar Contraseña (Opcional)</h3>

            {{-- Contraseña --}}
            <x-wireui-input 
                label="Nueva Contraseña"
                name="password"
                type="password"
                placeholder="Mínimo 8 caracteres"
                class="mt-4"
            />

            {{-- Confirmación de Contraseña --}}
            <x-wireui-input 
                label="Confirmar Contraseña"
                name="password_confirmation"
                type="password"
                placeholder="Repite la nueva contraseña"
                class="mt-4"
            />

            <div class="flex justify-end mt-6">
                <x-wireui-button type="submit" blue icon="pencil-square" class="font-semibold">
                    Actualizar Usuario
                </x-wireui-button>
            </div>

        </form>

    </x-wireui-card>

</x-admin-layout>