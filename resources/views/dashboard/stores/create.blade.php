@extends('layouts.dashboard')
@section('title', 'Stores')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Stores</li>
@endsection
@section('content')
    <form action="{{ route('dashboard.stores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('dashboard.stores._form')
    </form>
@endsection
