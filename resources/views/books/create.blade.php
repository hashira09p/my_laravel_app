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
                        <form id="book-form">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Book Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter book title">
                                <div class="text-danger" id="title-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="author_id" class="form-label">Author</label>
                                <select name="author_id" id="author_id" class="form-select">
                                    <option value="">-- Select an Author --</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger" id="author_id-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="published_date" class="form-label">Published Date</label>
                                <input type="date" name="published_date" id="published_date" class="form-control">
                                <div class="text-danger" id="published_date-error"></div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Save Book</button>
                            </div>
                        </form>

                        <div id="success-message" class="mt-3 text-success text-center"></div>

                        <div class="mt-3 text-center">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to Books</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#book-form").submit(function (event) {
                event.preventDefault();

                $("#success-message").html("");
                $(".text-danger").html("");

                let formData = {
                    title: $("#title").val(),
                    author_id: $("#author_id").val(),
                    published_date: $("#published_date").val(),
                    _token: $('meta[name="csrf-token"]').attr("content")
                };

                console.log("Sending AJAX Request:", formData);

                $.ajax({
                    url: "{{ route('books.store') }}",
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        console.log("AJAX Success:", response);
                        $("#success-message").html("<p>Book Added Successfully!</p>");
                        $("#book-form")[0].reset();
                    },
                    error: function (xhr) {
                        console.log("AJAX Error:", xhr);
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
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
                            console.log("Unexpected Error:", xhr.responseText);
                        }
                    }
                });
            });
        });
    </script>
@endsection