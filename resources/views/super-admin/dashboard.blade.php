<x-app-layout>
    <x-slot name="header">
        @include('components.admin-nav')
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-2xl font-semibold mb-6">All Users</h2>
                <div class="overflow-x-auto">
                    <table id="users-table" class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr class="text-left text-sm font-semibold text-gray-600 uppercase">
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Role(s)</th>
                                <th class="border px-4 py-2">Created At</th>
                                <th class="border px-4 py-2">Action</th>

                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @foreach ($users as $index => $user)
                                <tr class="text-center">
                                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    </td>
                                    <td class="border px-4 py-2">{{ $user->created_at->format('Y-m-d') }}</td>

                                    <td class="border px-4 py-2">
                                        {{-- <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-blue-600 hover:underline">Update</a> --}}

                                             <form action="{{ route('users.edit', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:underline">Update</button>
                                        </form>

                                        <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
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
