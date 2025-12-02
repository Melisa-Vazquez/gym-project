<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserTable extends DataTableComponent
{
    /**
     * Escuchar eventos externos para refrescar la tabla.
     */
    protected $listeners = ['refreshTable' => '$refresh'];

    /**
     * Modelo base del DataTable.
     */
    protected $model = User::class;

    /**
     * Constructor de la consulta.
     */
    public function builder(): Builder
    {
        return User::query()->with('roles');
    }

    /**
     * Configuración general.
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    /**
     * Columnas de la tabla.
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

            Column::make("Email", "email")
                ->sortable()
                ->searchable(),

            Column::make("Rol")
                ->label(fn($row) => $row->roles->pluck('name')->first() ?? 'Sin rol'),

            Column::make("Estado", "is_active")
                ->sortable()
                ->format(fn ($value) =>
                    $value
                        ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Activo</span>'
                        : '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Inactivo</span>'
                )
                ->html(),

            Column::make("Registrado el", "created_at")
                ->sortable()
                ->format(fn ($value) =>
                    $value instanceof \Illuminate\Support\Carbon
                        ? $value->format('d/m/Y')
                        : $value
                ),

            Column::make("Acciones")
                ->label(fn ($row) =>
                    view('admin.usuarios.actions', ['usuario' => $row])
                )
                ->html(),
        ];
    }

    /**
     * Activar o desactivar un usuario.
     */
    public function toggleActive(int $id): void
    {
        $user = User::findOrFail($id);

        $user->is_active = !$user->is_active;
        $user->save();

        // Refrescar tabla
        $this->dispatch('refreshTable');

        // Notificación WireUI
        $this->dispatch('notify', [
            'title'       => 'Estado actualizado',
            'description' => "El usuario {$user->name} ahora está " . ($user->is_active ? 'activo' : 'inactivo') . ".",
            'icon'        => $user->is_active ? 'success' : 'error'
        ]);
    }
}
