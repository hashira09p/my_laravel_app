@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Add Book</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Book Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                                    placeholder="Enter book title">
                            </div>

                            <div class="mb-3">
                                <label for="author_id" class="form-label">Author</label>
                                <select name="author_id" id="author_id" class="form-select">
                                    <option value="">-- Select an Author --</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="published_date" class="form-label">Published Date</label>
                                <input type="date" name="published_date" id="published_date" class="form-control">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Save Book</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to Books</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection