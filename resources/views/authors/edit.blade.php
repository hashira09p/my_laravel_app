@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">Edit Author</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('authors.update', $author->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $author->name }}"
                                    placeholder="Enter author name" required>
                            </div>

                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control"
                                    value="{{ $author->birth_date }}" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-block">Update Author</button>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('authors.index') }}" class="btn btn-secondary">← Back to Authors</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection