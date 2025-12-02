<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Profile',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Melisa',
    ],
]">

    <!-- Contenedor principal -->
    <div class="p-6 bg-gray-100 min-h-screen">

        <!-- Título de la página -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Perfil de Melisa</h1>

        <!-- Tarjeta de información -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
            <div class="flex items-center space-x-4">
                <img src="https://i.pravatar.cc/100?img=5" alt="Foto de Melisa" class="w-24 h-24 rounded-full border-4 border-indigo-500">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Melisa Nef</h2>
                    <p class="text-gray-500">Administrador del sistema</p>
                    <p class="text-gray-500">melisa@example.com</p>
                </div>
            </div>
        </div>

        <!-- Sección de detalles adicionales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-gray-700 mb-2">Rol</h3>
                <p>Administrador</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-gray-700 mb-2">Última sesión</h3>
                <p>1 de diciembre, 2025 - 10:30 AM</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-gray-700 mb-2">Membresía</h3>
                <p>Premium</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-gray-700 mb-2">Actividades recientes</h3>
                <p>Gestión de usuarios, Configuración del sistema</p>
            </div>
        </div>

    </div>

</x-admin-layout>
