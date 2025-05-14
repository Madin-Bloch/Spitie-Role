<x-app-layout>
    <x-slot name="header">Create Permission</x-slot>

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Permission name" required>
        <button type="submit">Create</button>
    </form>
</x-app-layout>
