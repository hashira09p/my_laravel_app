@extends('layouts.app')

@section('content')
    <h1>List of Books</h1>
    <a href="{{ route('books.create') }}">Add New Books</a>
    <ul>
        @foreach($books as $book)
            <li>{{ $book->name }} ({{ $book->birth_date }})</li>
        @endforeach
    </ul>
@endsection