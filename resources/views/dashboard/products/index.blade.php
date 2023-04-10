@extends('layouts.dashboard')
@section('title', 'Products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection
@section('content')
    <div class="mb-5">
        @if (Auth::user()->can('products.create'))
            <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        @endif
        {{-- <a href="{{ route('dashboard.products.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a> --}}

    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="draft" @selected(request('status') == 'draft')>Draft</option>
            <option value="archvied" @selected(request('status') == 'archvied')>Archvied</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>
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
                                    class="btn btn-sm btn-outline-success">Edite</a>
                            @endcan
                        </td>
                        <td>
                            @can('categories.delete')
                                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
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
    {{ $products->withQueryString()->appends(['search' => 1])->links() }}
@endsection
