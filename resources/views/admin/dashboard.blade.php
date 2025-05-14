<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Welcome Message -->
        <div class="bg-white shadow-md rounded-2xl p-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">
                Welcome {{ implode(', ', $roles->toArray()) }}
            </h1>
        </div>

        <!-- Permissions List -->
        <div class="mt-8 bg-white shadow-md rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                You Have the Following Permissions:
            </h2>
            <ul class="list-disc list-inside space-y-2 text-gray-600">
                @foreach ($permissions as $permission)
                    <li>{{ $permission->name }}</li>
                @endforeach
            </ul>
        </div>
        @can('edit')
            <button class="text-black"> Ha Edit</button>
        @endcan <br>
                @can('delete')
            <button class="text-black bg-blue-400 px-3 py-4 rounded"> Ha Delete</button>
            @endcan
            
            @can('create')
            <button class="text-black bg-blue-400 px-3 py-4 rounded"> Ha Create</button>
            
        @endcan
    </div>
</x-app-layout>
