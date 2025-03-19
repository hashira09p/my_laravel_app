@extends('layouts.app')

@section('content')
    <h1>Create Author</h1>
    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="date" name="birth_date" required>
        <button type="submit">Save</button>
    </form>
@endsection