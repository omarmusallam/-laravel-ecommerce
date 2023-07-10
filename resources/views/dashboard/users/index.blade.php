@extends('layouts.dashboard')

@section('title', 'Users')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')

    {{-- <div class="mb-5">
        <a href="{{ route('dashboard.users.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    </div> --}}

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
                <th>Created At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('dashboard.users.edit', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @can('users.update')
                            <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        @endcan
                    </td>
                    <td>
                        @can('users.delete')
                            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post">
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
                    <td colspan="6">No users defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->withQueryString()->links() }}

@endsection
