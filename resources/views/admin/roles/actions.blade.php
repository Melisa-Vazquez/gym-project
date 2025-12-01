<!-- resources/views/admin/roles/actions.blade.php -->
<div class="flex items-center space-x-2">
    <x-wireui-button href="{{ route('admin.roles.edit', $role) }}" blue xs>
        <i class="fa-solid fa-pen-to-square mr-1"></i>

    </x-wireui-button>
    
    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')

        <x-wireui-button type="submit" red xs>
            <i class="fa-solid fa-trash"></i>
        </x-wireui-button>

    </form>      
</div>