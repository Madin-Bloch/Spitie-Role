<x-app-layout>
    <x-slot name="header">Create Role</x-slot>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Role name" required>
        <button type="submit">Create</button>
    </form>
</x-app-layout>


<x-app-layout>
    

     <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('components.admin-nav')

    </div>

</x-app-layout>
