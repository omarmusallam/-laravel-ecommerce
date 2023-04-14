@extends('layouts.dashboard')
@section('title')
    <h1 class="m-0">Notifications - {{ $newCount }}</h1>
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">notifications</li>
@endsection
@section('content')
    <!-- Main content -->
    @foreach ($notifications as $notification)
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Number : {{ $notification->data['order_id'] }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body text-primary">
                                {{ $notification->data['body'] }}
                                <a href="{{ route('dashboard.orders.show', $notification->data['order_id']) }}"
                                    class="btn btn-sm btn-outline-primary float-right">Show Order</a>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    <!-- /.content -->
    {{ $notifications->withQueryString()->links() }}
@endsection
