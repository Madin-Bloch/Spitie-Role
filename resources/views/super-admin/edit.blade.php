<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Name</label>
                <input type="text" name="name" value="{{ $user->name }}"
                    class="w-full border px-4 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}"
                    class="w-full border px-4 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label>Role</label>
                <select name="role" class="w-full border px-4 py-2 rounded">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ $role == $userRole ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Permissions</label>
                @foreach ($permissions as $permission)
                    <label class="inline-flex items-center mr-4 mb-2">
                        <input type="checkbox" name="permissions[]"
                               value="{{ $permission }}"
                               {{ in_array($permission, $userPermissions) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
