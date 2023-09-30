@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.products.store') }}" method="post" id="yourFormId" enctype="multipart/form-data">
        @csrf

        @include('dashboard.products._form')
    </form>

    @push('scripts')
        {{-- create a new category with ajax request --}}
        <script>
            $(document).ready(function() {
                $(document).on('click', '#create_product', function(event) {
                    event.preventDefault();

                    var formData = new FormData($('#yourFormId')[0]);

                    $.ajax({
                        url: "{{ route('dashboard.products.store') }}",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            toastr.success('Products Created Successfully', '', {
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
