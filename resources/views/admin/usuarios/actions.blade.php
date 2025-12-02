<div class="flex items-center space-x-2">
    
    {{-- Botón de editar --}}
    <x-wireui-button href="{{ route('admin.usuarios.edit', $usuario) }}" blue xs>
        <i class="fa-solid fa-pen-to-square mr-1"></i>
    </x-wireui-button>

    {{-- 🚫 OCULTAR BOTONES SI EL USUARIO ES ADMINISTRADOR --}}
    @unless($usuario->hasRole('Administrador'))
        
        {{-- Activar / Desactivar --}}
        @if ($usuario->is_active)
            <x-wireui-button 
                xs red
                wire:click="toggleActive({{ $usuario->id }})"
            >
                <i class="fas fa-toggle-off mr-1"></i>
            </x-wireui-button>
        @else
            <x-wireui-button 
                xs green
                wire:click="toggleActive({{ $usuario->id }})"
            >
                <i class="fas fa-toggle-on mr-1"></i>
            </x-wireui-button>
        @endif

    @endunless

</div>
