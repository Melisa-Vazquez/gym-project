<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserTable extends DataTableComponent
{
    // Modelo base de la tabla
    public function builder(): Builder
    {
        return User::query()->with('roles');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),

            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),

            Column::make("Email", "email")
                ->sortable()
                ->searchable(),

            Column::make("Número de ID", "id_number")
                ->sortable()
                ->searchable(),

            Column::make("Teléfono", "phone")
                ->sortable()
                ->searchable(),

            Column::make("Rol")
                ->label(function ($row) {
                    return $row->roles->first()?->name ?? 'Sin rol';
                })
                ->searchable(),

            Column::make("Acciones")
                ->label(function ($row) {
                    // Archivo correcto: resources/views/admin/usuarios/actions.blade.php
                    return view('admin.usuarios.actions', ['usuario' => $row]);
                })
                ->html(),
        ];
    }
}
