
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Category Details</span>
                    <div>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">ID:</div>
                        <div class="col-md-8">{{ $category->id }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Name:</div>
                        <div class="col-md-8">{{ $category->name }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Parent Category:</div>
                        <div class="col-md-8">{{ $category->parent ? $category->parent->name : 'None' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Created At:</div>
                        <div class="col-md-8">{{ $category->created_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Updated At:</div>
                        <div class="col-md-8">{{ $category->updated_at->format('Y-m-d H:i:s') }}</div>
                    </div>

                    <hr>

                    <h5>Subcategories</h5>
                    @if($category->children->count() > 0)
                        <ul class="list-group">
                            @foreach($category->children as $child)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $child->name }}
                                    <span class="badge bg-primary rounded-pill">{{ $child->products_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No subcategories found.</p>
                    @endif

                    <hr>

                    <h5>Products in this Category</h5>
                    @if($category->products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No products found in this category.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection