@extends('layouts.dashboard')
@section('title', 'Stores')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Stores</li>
@endsection
@section('content')
    <div class="mb-5">
        @if (Auth::user()->can('stores.create'))
            <a href="{{ route('dashboard.stores.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        @endif
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="inactive" @selected(request('status') == 'inactive')>inActive</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Products #</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @if ($stores->count())
                @foreach ($stores as $store)
                    <tr>
                        <td><img src="{{ asset('storage/' . $store->logo_image) }}" alt="" height="50px"></td>
                        <td>{{ $store->id }}</td>
                        <td><a href="{{ route('dashboard.stores.show', $store->id) }}">{{ $store->name }}</a></td>
                        <td>{{ $store->description }}</td>
                        <td>{{ $store->products_count }}</td>
                        <td>{{ $store->status }}</td>
                        <td>{{ $store->created_at }}</td>
                        <td>{{ $store->updated_at }}</td>
                        <td>
                            @can('stores.update')
                                <a href="{{ route('dashboard.stores.edit', $store->id) }}"
                                    class="btn btn-sm btn-outline-success">Edite</a>
                            @endcan
                        </td>
                        <td>
                            @can('stores.delete')
                                <form action="{{ route('dashboard.stores.destroy', $store->id) }}" method="POST">
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
                    <td colspan="9">No stores defined.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $stores->withQueryString()->links() }}
@endsection
