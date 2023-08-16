@extends('layouts.dashboard')

@section('title', 'Edit Settings')

@section('breadcrumb')
@parent
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item active">Edit Settings</li>
@endsection

@section('content')

<form action="{{ route('dashboard.setting.update', $setting->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    @include('dashboard.settings._form')
</form>

@endsection