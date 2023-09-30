<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @if ($products->count())
            @foreach ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50px"></td>
                    <td>{{ $product->id }}</td>
                    <td><a href="{{ route('dashboard.products.edit', $product->id) }}">{{ $product->name }}</a></td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        @can('products.update')
                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                        @endcan
                    </td>
                    <td>
                        @can('products.delete')
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
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
                <td colspan="9">No products defined.</td>
            </tr>
        @endif
    </tbody>
</table>
