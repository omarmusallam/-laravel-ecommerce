@extends('layouts.dashboard')
@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')
    <div class="mb-5">
        @if (Auth::user()->can('categories.create'))
            <a title="Create category" href="{{ route('dashboard.categories.create') }}"
                class="btn btn-sm btn-outline-primary mr-2"><i class="fas fa-plus"></i></a>
            <a title="Recycle bin" href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark"><i
                    class="fas fa-trash-alt"></i></a>
        @endif
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" id="search" :value="request('name')" />

        <select name="status" class="form-control mx-2" id="status">
            <option value="">All</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
        </select>

    </form>
    <div class="ajax_search_result">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Products #</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @if ($categories->count())
                    @foreach ($categories as $category)
                        <tr>
                            <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50px"></td>
                            <td>{{ $category->id }}</td>
                            <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a>
                            </td>
                            <td>{{ $category->parent->name }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>{{ $category->status }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>
                                @can('categories.update')
                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                                @endcan
                            </td>
                            <td>
                                @can('categories.delete')
                                    <button class="btn btn-sm btn-outline-danger delete-category"
                                        data-category-id="{{ $category->id }}"><i class="fas fa-trash"></i></button>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">No categories defined.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    {{ $categories->withQueryString()->links() }}
    @push('scripts')
        {{-- search with ajax --}}
        <script>
            $(document).ready(function() {
                // استدعاء الوظيفة عند تغيير قيمة الحقل البحث
                $(document).on('input', '#search', function() {
                    searchCategories();
                });

                // استدعاء الوظيفة عند تغيير قيمة حقل الحالة
                $(document).on('change', '#status', function() {
                    searchCategories();
                });

                function searchCategories() {
                    var search = $('#search').val();
                    var status = $('#status').val();

                    if (search === '') {
                        search = 'restore';
                    }

                    $.ajax({
                        url: "{{ route('dashboard.ajax_search_categories') }}",
                        type: 'POST',
                        dataType: 'html',
                        cache: false,
                        data: {
                            search: search,
                            status: status,
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $('.ajax_search_result').html(data);
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        </script>
        {{-- delete with ajax --}}
        <script>
            $(document).ready(function() {
                $('.delete-category').click(function() {
                    const $button = $(this);
                    const categoryId = $button.data('category-id');

                    $.ajax({
                        url: '/admin/dashboard/categories/' + categoryId,
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

            });
        </script>
    @endpush
@endsection
