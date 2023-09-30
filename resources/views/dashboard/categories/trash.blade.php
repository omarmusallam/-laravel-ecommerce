@extends('layouts.dashboard')

@section('title', 'Trashed Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active">Trashed</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary"><i
                class="fas fa-arrow-left"></i></a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th>Edite</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->count())
                @foreach ($categories as $category)
                    <tr>
                        <td><img src="{{ asset('storage/' . $category->image) }}" alt="this is image" height="50px"></td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->deleted_at }}</td>
                        <td>
                            <button data-category-id="{{ $category->id }}"
                                class="btn btn-sm btn-outline-info restore-category"><i class="fas fa-undo"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger delete-category"
                                data-category-id="{{ $category->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">No categories defined.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $categories->withQueryString()->appends(['search' => 1])->links() }}

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.delete-category').click(function() {
                    const $button = $(this);
                    const categoryId = $button.data('category-id');

                    $.ajax({
                        url: '/admin/dashboard/categories/' + categoryId + '/force-delete',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $button.closest('tr').remove();

                            toastr.success('Deleted Done', '', {
                                closeButton: true,
                                progressBar: true,
                                positionClass: 'toast-top-right'
                            });
                        },
                        error: function(xhr) {
                            toastr.error('Failed to delete');
                        }
                    });
                });
                $('.restore-category').click(function() {
                    const $button = $(this);
                    const categoryId = $button.data('category-id');

                    $.ajax({
                        url: '/admin/dashboard/categories/' + categoryId + '/restore',
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $button.closest('tr').remove();

                            toastr.success('Restore Done', '', {
                                closeButton: true,
                                progressBar: true,
                                positionClass: 'toast-top-right'
                            });
                        },
                        error: function(xhr) {
                            toastr.error('Failed to restore');
                        }
                    });
                });

            });
        </script>
    @endpush
@endsection
