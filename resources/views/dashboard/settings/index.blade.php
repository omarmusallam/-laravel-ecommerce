@extends('layouts.dashboard')

@section('title', 'Settings')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Settings</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.setting') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.settings._form')
    </form>

@endsection
