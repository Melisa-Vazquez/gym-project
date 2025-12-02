<x-admin-layout title="Membresías | Nuevo Plan | GYM Lixie" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Membresías',
        'href' => route('admin.membresias.index'),
    ],
    [
        'name' => 'Nuevo Plan',
    ],
]">

    <x-wireui-card>
        <form action="{{ route('admin.membresias.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Nombre --}}
                <div class="md:col-span-2">
                    <x-wireui-input 
                        label="Nombre del Plan de Membresía"
                        name="name"
                        placeholder="Ej: Plan Anual VIP"
                        value="{{ old('name') }}"
                    />
                </div>

                {{-- Precio --}}
                <x-wireui-input 
                    label="Precio ($)"
                    name="price"
                    placeholder="29.99"
                    type="number"
                    step="0.01"
                    value="{{ old('price') }}"
                />

                {{-- Duración --}}
                <x-wireui-input 
                    label="Duración (Meses)"
                    name="duration_months"
                    placeholder="1, 3, 12, etc."
                    type="number"
                    min="1"
                    value="{{ old('duration_months') }}"
                />
                {{-- Estado --}}
<x-wireui-select
    label="Estado"
    placeholder="Selecciona el estado"
    :options="[
        ['id' => 'active', 'name' => 'Activa'],
        ['id' => 'inactive', 'name' => 'Inactiva'],
    ]"
    option-value="id"
    option-label="name"
    name="status"
    :selected="old('status')"
    clearable="false"
    required
/>


                {{-- Descripción --}}
                <div class="md:col-span-2">
                    <x-wireui-textarea 
                        label="Descripción de Beneficios"
                        name="description"
                        placeholder="Detalles de lo que incluye: acceso 24/7, clases ilimitadas, sauna, etc."
                    >{{ old('description') }}</x-wireui-textarea>
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <x-wireui-button type="submit" blue>
                    Crear Plan de Membresía
                </x-wireui-button>
            </div>
        </form>
    </x-wireui-card>

</x-admin-layout>
