@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Books</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form method="GET" action="{{ route('books.index') }}" class="d-flex">
                <div class="input-group" style="max-width: 300px; width: 100%;">
                    <input type="text" name="search" class="form-control" placeholder="Search Books"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </div>
            </form>

            <a href="{{ route(name: 'books.create') }}" class="btn btn-primary">Add New Book</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>{{ $book->published_date }}</td>
                            <td>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this book?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $books->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection