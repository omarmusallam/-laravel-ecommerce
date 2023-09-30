@extends('layouts.dashboard')
@section('title', 'Edit Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Edit Categories</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.categories._form', [
            'button_lable' => 'Update',
        ])
    </form>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteImageBtn = document.getElementById('delete-image-btn');

                if (deleteImageBtn) {
                    deleteImageBtn.addEventListener('click', function() {
                        if (confirm('Are you sure you want to delete the image?')) {
                            // إرسال طلب AJAX لحذف الصورة
                            axios.post(`/admin/dashboard/delete-image/{{ $category->id }}`)
                                .then(function(response) {
                                    // تنفيذ إجراء بعد حذف الصورة بنجاح
                                    const imageElement = document.querySelector('.img-fit');
                                    if (imageElement) {
                                        imageElement.remove();
                                    }
                                    // إخفاء زر حذف الصورة
                                    deleteImageBtn.style.display = 'none';
                                })
                                .catch(function(error) {
                                    console.error('An error occurred while deleting the image: ', error);
                                });
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
