@extends('layouts.dashboard')
@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')
    <form action="{{ route('dashboard.categories.store') }}" id="yourFormId" method="POST" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form')
    </form>

    @push('scripts')
        {{-- create a new category with ajax request --}}
        <script>
            $(document).ready(function() {
                $(document).on('click', '#create_category', function(event) {
                    event.preventDefault();

                    var formData = new FormData($('#yourFormId')[0]);

                    $.ajax({
                        url: "{{ route('dashboard.categories.store') }}",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            toastr.success('Category Created', '', {
                                closeButton: true,
                                progressBar: true,
                                positionClass: 'toast-top-right'
                            });
                        },
                        error: function(data) {
                            // Check if the response contains validation errors
                            if (data.responseJSON && data.responseJSON.errors) {
                                var errors = data.responseJSON.errors;

                                // Display validation errors to the user
                                var errorMessages = '';
                                $.each(errors, function(field, messages) {
                                    $.each(messages, function(key, message) {
                                        errorMessages += message + '<br>';
                                    });
                                });

                                toastr.error(errorMessages, 'Validation Errors', {
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: 'toast-top-right'
                                });
                            } else {
                                toastr.error('Failed to save');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
