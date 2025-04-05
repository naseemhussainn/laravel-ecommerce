
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Order #{{ $order->id }}</span>
                    <div>
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ $order->status == 'completed' ? 'pending' : 'completed' }}">
                            <button type="submit" class="btn btn-sm {{ $order->status == 'completed' ? 'btn-warning' : 'btn-success' }}">
                                {{ $order->status == 'completed' ? 'Mark Pending' : 'Complete Order' }}
                            </button>
                        </form>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Order Information</h5>
                            <div class="row mb-2">
                                <div class="col-md-5 font-weight-bold">Order ID:</div>
                                <div class="col-md-7">{{ $order->id }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 font-weight-bold">Order Date:</div>
                                <div class="col-md-7">{{ $order->created_at->format('Y-m-d H:i:s') }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 font-weight-bold">Status:</div>
                                <div class="col-md-7">
                                    @if($order->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Customer Information</h5>
                            <div class="row mb-2">
                                <div class="col-md-5 font-weight-bold">Name:</div>
                                <div class="col-md-7">{{ $order->user->name }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 font-weight-bold">Email:</div>
                                <div class="col-md-7">{{ $order->user->email }}</div>
                            </div>
                        </div>
                    </div>

                    <h5>Order Items</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/'.$item->product->image) }}" width="50" class="me-2" alt="{{ $item->product->name }}">
                                        @endif
                                        <div>{{ $item->product->name }}</div>
                                    </div>
                                </td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Subtotal:</th>
                                <th>${{ number_format($order->total, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Tax:</th>
                                <th>$0.00</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <th>${{ number_format($order->total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection