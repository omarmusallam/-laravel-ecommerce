@extends('layouts.dashboard')

@section('title', 'Roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')

    <div class="mb-5">
        @can('roles.create')
            <a title="Create role" href="{{ route('dashboard.roles.create') }}" class="btn btn-sm btn-outline-primary mr-2"><i
                    class="fas fa-plus"></i></a>
        @endcan
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <button class="btn btn-primary mx-2">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td><a href="{{ route('dashboard.roles.edit', $role->id) }}">{{ $role->name }}</a></td>
                    <td>{{ $role->created_at }}</td>
                    @can('roles.update')
                        <td>
                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-sm btn-outline-success"><i
                                    class="fas fa-edit"></i></a>
                        </td>
                    @endcan
                    @can('roles.delete')
                        <td>
                            <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post">
                                @csrf
                                <!-- Form Method Spoofing -->
                                <input type="hidden" name="_method" value="delete">
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <td colspan="4">No roles defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $roles->withQueryString()->links() }}

@endsection
