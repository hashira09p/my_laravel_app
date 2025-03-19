@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Authors</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form method="GET" action="{{ route('authors.index') }}" class="d-flex">
                <div class="input-group" style="max-width: 300px; width: 100%;">
                    <input type="text" name="search" class="form-control" placeholder="Search Authors"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </div>
            </form>

            <a href="{{ route('authors.create') }}" class="btn btn-primary">Add Author</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Birth Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $index => $author)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->birth_date }}</td>
                            <td>
                                <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this author?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No authors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $authors->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection