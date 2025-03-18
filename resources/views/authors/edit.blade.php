@extends('layouts.app')

@section('content')
    <h1>Update Author</h1>
    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" placeholder="Name" required>
        <input type="date" name="birth_date" required>
        <button type="submit">Save</button>
    </form>
@endsection