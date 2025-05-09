@extends('layouts.app')

@section('content')
    <h1>Edit Event</h1>
    <form method="POST" action="{{ route('events.update', $event) }}">
        @csrf
        @method('PUT')
        <input name="title" value="{{ $event->title }}">
        <textarea name="description">{{ $event->description }}</textarea>
        <input type="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
        <button type="submit">Update</button>
    </form>
@endsection
