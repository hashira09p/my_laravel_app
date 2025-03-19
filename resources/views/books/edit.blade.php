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
                        <form id="edit-book-form">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Book Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $book->title }}" placeholder="Enter book title">
                                <div class="text-danger" id="title-error"></div>
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
                                <div class="text-danger" id="author_id-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="published_date" class="form-label">Published Date</label>
                                <input type="date" name="published_date" id="published_date" class="form-control"
                                    value="{{ $book->published_date }}">
                                <div class="text-danger" id="published_date-error"></div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-block">Update Book</button>
                            </div>

                            <div id="success-message" class="mt-3 text-success text-center"></div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to Books</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#edit-book-form").submit(function (event) {
                event.preventDefault(); // Prevent normal form submission

                $("#success-message").html(""); // Clear previous messages
                $(".text-danger").html(""); // Clear error messages

                let formData = $(this).serialize();
                let updateUrl = "{{ route('books.update', $book->id) }}"; // Update URL

                $.ajax({
                    url: updateUrl,
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        $("#success-message").html("<p>Book Updated Successfully!</p>");
                        setTimeout(() => {
                            window.location.href = "{{ route('books.index') }}"; // Redirect after success
                        }, 2000);
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) { // Validation Error
                            let errors = xhr.responseJSON.errors;
                            if (errors.title) {
                                $("#title-error").html(errors.title[0]);
                            }
                            if (errors.author_id) {
                                $("#author_id-error").html(errors.author_id[0]);
                            }
                            if (errors.published_date) {
                                $("#published_date-error").html(errors.published_date[0]);
                            }
                        } else {
                            alert("Something went wrong. Please try again.");
                        }
                    }
                });
            });
        });
    </script>
@endsection