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
                    <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
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
                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                        class="fas fa-trash"></i></button>
                            </form>
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
