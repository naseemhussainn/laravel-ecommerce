
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Document Details</span>
                    <div>
                        <a href="{{ route('admin.documents.edit', $document) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.documents.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">ID:</div>
                        <div class="col-md-8">{{ $document->id }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Title:</div>
                        <div class="col-md-8">{{ $document->title }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Product:</div>
                        <div class="col-md-8">{{ $document->product->name }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Type:</div>
                        <div class="col-md-8">{{ $document->type }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Issue Date:</div>
                        <div class="col-md-8">{{ $document->issue_date->format('Y-m-d') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">File:</div>
                        <div class="col-md-8">
                            <a href="{{ route('documents.download', $document) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-download"></i> Download Document
                            </a>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Created At:</div>
                        <div class="col-md-8">{{ $document->created_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Updated At:</div>
                        <div class="col-md-8">{{ $document->updated_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection