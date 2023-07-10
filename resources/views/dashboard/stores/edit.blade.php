@extends('layouts.dashboard')
@section('title', 'Edit Stores')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Stores</li>
    <li class="breadcrumb-item active">Edit Stores</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.stores._form', [
            'button_lable' => 'Update'
        ])
    </form>
@endsection
