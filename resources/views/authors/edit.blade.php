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
                        <form id="edit-author-form">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" 
                                    value="{{ $author->name }}" placeholder="Enter author name">
                                <div class="text-danger" id="name-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control" 
                                    value="{{ $author->birth_date }}">
                                <div class="text-danger" id="birth_date-error"></div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-block">Update Author</button>
                            </div>

                            <div id="success-message" class="mt-3 text-success text-center"></div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('authors.index') }}" class="btn btn-secondary">← Back to Authors</a>
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
            $("#edit-author-form").submit(function (event) {
                event.preventDefault(); // Prevent normal form submission

                $("#success-message").html(""); // Clear previous messages
                $(".text-danger").html(""); // Clear error messages

                let formData = $(this).serialize();
                let updateUrl = "{{ route('authors.update', $author->id) }}"; // Update URL

                $.ajax({
                    url: updateUrl,
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        $("#success-message").html("<p>Author Updated Successfully!</p>");
                        setTimeout(() => {
                            window.location.href = "{{ route('authors.index') }}"; // Redirect after success
                        }, 2000);
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) { // Validation Error
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $("#name-error").html(errors.name[0]);
                            }
                            if (errors.birth_date) {
                                $("#birth_date-error").html(errors.birth_date[0]);
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