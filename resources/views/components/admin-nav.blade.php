<nav class="bg-gray-100 p-4 rounded mb-6 shadow">
    <ul class="flex justify-between">
        <li>
            @role('Super Admin')
                <a href="{{ route('super-admin-dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">
                    Dashboard
                </a>
                @elserole('Admin')
                <a href="{{ route('admin-dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">
                    Dashboard
                </a>
            @endrole
        </li>
        <li>
            @role('Super Admin')
                <a href="{{ route('super-admin.users.create') }}" class="text-gray-700 hover:text-indigo-600 font-medium">
                    Create User
                </a>
                @elserole('Admin')
                <a href="{{ route('admin.users.create') }}"
                    class="text-gray-700 bg-red-200 hover:text-indigo-600 font-medium">
                    Create User
                </a>
            @endrole
        </li>

        @role('Super Admin')
            <li>
                <a href="{{ route('roles.index') }}" class="text-gray-700 hover:text-indigo-600 font-medium">
                     Roles
                </a>
            </li>

            <li>
                <a href="{{ route('permissions.index') }}" class="text-gray-700 hover:text-indigo-600 font-medium">
                     Permissons
                </a>
            </li>
            
            {{-- <li>
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">
                    Menage Roles
                </a>
            </li> --}}
        @endrole


    </ul>
</nav>
