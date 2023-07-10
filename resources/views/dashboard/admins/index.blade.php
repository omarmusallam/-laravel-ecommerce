@extends('layouts.dashboard')

@section('title', 'Admins')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admins</li>
@endsection

@section('content')

    <div class="mb-5">
        <a href="{{ route('dashboard.admins.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <x-form.input name="email" placeholder="Email" class="mx-2" :value="request('email')" />
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Store</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td><a href="{{ route('dashboard.admins.edit', $admin->id) }}">{{ $admin->name }}</a></td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->store->name }}</td>
                    <td>{{ $admin->created_at }}</td>
                    <td>{{ $admin->updated_at }}</td>
                    <td>
                        @can('admins.update')
                            <a href="{{ route('dashboard.admins.edit', $admin->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        @endcan
                    </td>
                    <td>
                        @can('admins.delete')
                            <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="post">
                                @csrf
                                <!-- Form Method Spoofing -->
                                <input type="hidden" name="_method" value="delete">
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No admins defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $admins->withQueryString()->links() }}

@endsection
