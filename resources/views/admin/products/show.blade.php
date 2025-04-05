@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Product Details</span>
                    <div>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                            @else
                                <div class="text-center p-5 bg-light">No Image</div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                            
                            <div class="row mb-2">
                                <div class="col-md-4 font-weight-bold">Category:</div>
                                <div class="col-md-8">{{ $product->category->parent->name }} > {{ $product->category->name }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-4 font-weight-bold">Price:</div>
                                <div class="col-md-8">${{ number_format($product->price, 2) }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-4 font-weight-bold">Stock:</div>
                                <div class="col-md-8">{{ $product->stock }}</div>
                            </div>
                            
                            @if($product->attributes)
                                @foreach($product->attributes as $key => $value)
                                    <div class="row mb-2">
                                        <div class="col-md-4 font-weight-bold">{{ ucfirst($key) }}:</div>
                                        <div class="col-md-8">{{ $value }}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4>Associated Documents</h4>
                        @if($product->documents->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Issue Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->documents as $document)
                                    <tr>
                                        <td>{{ $document->title }}</td>
                                        <td>{{ $document->type }}</td>
                                        <td>{{ $document->issue_date->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="{{ route('documents.download', $document) }}" class="btn btn-sm btn-info">Download</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No documents associated with this product.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection