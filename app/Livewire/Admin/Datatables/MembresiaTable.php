<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Membresia;
use Illuminate\Database\Eloquent\Builder;

class MembresiaTable extends DataTableComponent
{
    /**
     * Define el modelo Eloquent que se utilizará para esta tabla.
     */
    protected $model = Membresia::class;

    /**
     * Construye la consulta base para la tabla.
     */
    public function builder(): Builder
    {
        return Membresia::query();
    }

    /**
     * Configuración general de la tabla.
     */
public function configure(): void
{
    $this->setPrimaryKey('id');
}
    /**
     * Define las columnas de la tabla.
     */
    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable()
                ->searchable(),

            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),

            // Columna de Precio: Formato a moneda ($0.00)
            Column::make("Precio", "price")
                ->sortable()
                ->format(fn ($value) => '$' . number_format($value, 2)),

            // Columna de Duración: Añade " meses" al valor
            Column::make("Duración", "duration_months")
                ->sortable()
                ->format(fn ($value) => $value . " meses"),

            // Columna de Estado: Muestra una etiqueta de color basada en el valor
            // Columna de Estado: Muestra una etiqueta de color basada en el valor
Column::make("Estado", "status")
    ->sortable()
    ->format(function ($value) {
        return match ($value) {
            'active' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Activa</span>',
            'inactive' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Inactiva</span>',
            default => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-600">Sin estado</span>',
        };
    })
    ->html(),



 // Importante para renderizar el HTML del span

            // Columna de Fecha de Creación: Formato d/m/Y
            Column::make("Creada el", "created_at")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y')),

            // Columna de Acciones: Renderiza una vista Blade para los botones de Editar/Eliminar
            Column::make("Acciones")
                ->label(fn ($row) =>
                    // Asume que tienes una vista en 'resources/views/admin/membresias/actions.blade.php'
                    view('admin.membresias.actions', ["membresia" => $row])
                ),
        ];
    }
}