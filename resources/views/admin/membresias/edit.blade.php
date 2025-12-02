<x-admin-layout title="Membresías | Editar Plan | GYM Lixie" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Membresías', 'href' => route('admin.membresias.index')],
    ['name' => 'Editar Plan']
]">

    <x-wireui-card>
        {{-- Formulario de actualización. Utiliza 'PUT' para la actualización de recursos --}}
        <form action="{{ route('admin.membresias.update', $membresia) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nombre del Plan --}}
                <div class="md:col-span-2">
                    <x-wireui-input
                        label="Nombre del Plan de Membresía"
                        name="name"
                        placeholder="Ej: Plan Anual VIP"
                        value="{{ old('name', $membresia->name) }}"
                        required
                    />
                </div>

                {{-- Precio --}}
                <x-wireui-input
                    label="Precio ($)"
                    name="price"
                    placeholder="29.99"
                    type="number"
                    step="0.01"
                    value="{{ old('price', $membresia->price) }}"
                    required
                />

                {{-- Duración --}}
                <x-wireui-input
                    label="Duración (Meses)"
                    name="duration_months"
                    placeholder="1, 3, 12, etc."
                    type="number"
                    min="1"
                    value="{{ old('duration_months', $membresia->duration_months) }}"
                    required
                />

                {{-- Estado --}}
                <div class="md:col-span-2">
                    <x-wireui-select
                        label="Estado"
                        placeholder="Selecciona el estado"
                        :options="[
                            ['id' => 'active', 'name' => 'Activa'],
                            ['id' => 'inactive', 'name' => 'Inactiva']
                        ]"
                        option-value="id"
                        option-label="name"
                        name="status"
                        :selected="old('status', $membresia->status)"
                        clearable="false"
                        required
                    />
                </div>

                {{-- Descripción --}}
                <div class="md:col-span-2">
                    <x-wireui-textarea
                        label="Descripción de Beneficios"
                        name="description"
                        placeholder="Detalles de lo que incluye: acceso 24/7, clases ilimitadas, sauna, etc."
                        rows="4"
                    >{{ old('description', $membresia->description) }}</x-wireui-textarea>
                </div>

            </div>

            <div class="flex justify-end mt-6">
                {{-- Se cambió icon="refresh" a icon="arrow-path" para usar el nombre correcto en Heroicons --}}
                <x-wireui-button type="submit" primary icon="arrow-path" class="font-semibold">
                    Actualizar Plan de Membresía
                </x-wireui-button>
            </div>
        </form>
    </x-wireui-card>

</x-admin-layout>