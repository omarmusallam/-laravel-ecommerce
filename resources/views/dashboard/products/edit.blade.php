@extends('layouts.dashboard')

@section('title', 'Edit Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Products</li>
    <li class="breadcrumb-item active">Edit Product</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('dashboard.products._form', [
            'button_label' => 'Update',
        ])
    </form>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteImageIcons = document.querySelectorAll('.delete-icon');

                deleteImageIcons.forEach(icon => {
                    icon.addEventListener('click', function() {
                        const productId = this.getAttribute('data-product-id');
                        const imageId = this.getAttribute('data-image-id');
                        const imageType = this.getAttribute('data-image-type');

                        if (confirm('Are you sure you want to delete the image?')) {
                            axios.post(`/admin/dashboard/delete-product-image/${productId}`, {
                                    image_id: imageId,
                                    main_image: imageType === 'main',
                                })
                                .then(function(response) {
                                    const imageContainer = icon.parentElement;
                                    imageContainer.remove();

                                    toastr.success('Deleted successfully', '', {
                                        closeButton: true,
                                        progressBar: true,
                                        positionClass: 'toast-top-right'
                                    });
                                })
                                .catch(function(error) {
                                    toastr.error('Deletion failed');
                                });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
