<x-app-layout>
    <x-slot name="header">
        @include('components.admin-nav')
    </x-slot>

    <div class="py-10 space-y-10">
        <!-- Create Role Form -->
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Permissions</h2>
                <form action="{{ route('permissions.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Permissions Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter permissions name"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required>
                    </div>
                    <div>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                            Create Permissions
                        </button>
                    </div>
                </form>
            </div>
        </div>

      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">All Permissions</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 font-semibold text-gray-600">#</th>
                                <th class="px-6 py-3 font-semibold text-gray-600">Role Name</th>
                                <th class="px-6 py-3 font-semibold text-gray-600 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($permissions as $index => $role)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $role->name }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('permissions.destroy', $role->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this role?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:underline hover:text-red-800 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
