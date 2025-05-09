<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                @role('Admin|Super Admin')
                    <div class="mb-4">
                        <a href="{{ route('events.create') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Create Event
                        </a>
                    </div>
                @endrole

                @forelse ($events as $event)
                    <div class="border-b border-gray-200 py-4">
                        <h3 class="text-lg font-bold">{{ $event->title }} <span class="text-sm text-gray-500">({{ $event->date }})</span></h3>
                        <p class="text-gray-700">{{ $event->description }}</p>

                        @role('Admin|Super Admin')
                            <div class="mt-2 flex space-x-2">
                                <a href="{{ route('events.edit', $event) }}"
                                   class="text-blue-600 hover:underline">Edit</a>

                                <form method="POST" action="{{ route('events.destroy', $event) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:underline"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endrole
                    </div>
                @empty
                    <p class="text-gray-600">No events found.</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
