@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">Edit Book</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.update', $book->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Book Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title', $book->title) }}" placeholder="Enter book title">
                            </div>

                            <div class="mb-3">
                                <label for="author_id" class="form-label">Author</label>
                                <select name="author_id" id="author_id" class="form-select">
                                    <option value="">-- Select an Author --</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>
                                            {{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="published_date" class="form-label">Published Date</label>
                                <input type="date" name="published_date" id="published_date" class="form-control"
                                    value="{{ old('published_date', $book->published_date) }}">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Update Book</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to Books</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection