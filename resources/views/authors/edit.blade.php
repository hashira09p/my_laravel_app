@extends('layouts.app')

@section('content')
    <h1>Update Author</h1>
    <form action="{{ route('authors.update') }}" method="PUT">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="date" name="birth_date" required>
        <button type="submit">Save</button>
    </form>
@endsection