@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Add Author</h4>
                    </div>
                    <div class="card-body">
                        <form id="author-form">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter author name">
                                <div class="text-danger" id="name-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control">
                                <div class="text-danger" id="birth_date-error"></div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Save Author</button>
                            </div>
                        </form>

                        <div id="success-message" class="mt-3 text-success text-center"></div>

                        <div class="mt-3 text-center">
                            <a href="{{ route('authors.index') }}" class="btn btn-secondary">← Back to Authors</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#author-form").submit(function (event) {
                event.preventDefault();

                $("#success-message").html("");
                $(".text-danger").html("");

                let formData = {
                    name: $("#name").val(),
                    birth_date: $("#birth_date").val(),
                    _token: $('meta[name="csrf-token"]').attr("content")
                };

                console.log("Sending AJAX Request:", formData);

                $.ajax({
                    url: "{{ route('authors.store') }}",
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        console.log("AJAX Success:", response);
                        $("#success-message").html("<p>Author Added Successfully!</p>");
                        $("#author-form")[0].reset();
                    },
                    error: function (xhr) {
                        console.log("AJAX Error:", xhr);
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $("#name-error").html(errors.name[0]);
                            }
                            if (errors.birth_date) {
                                $("#birth_date-error").html(errors.birth_date[0]);
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