@extends('template.main')

@section('title', 'Home')

@section('nav')

    @include('template.header')
    @include('template.adminnav', ['active' => 'inventory'])

@endsection

@section('body')

@include('template.success')

<h1>Product List</h1>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($products) <= 0)
            <tr>
                <td colspan="7" class="text-center">No products</td>
            </tr>
            @endif
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <button class="px-1 pt-1 pb-1 btn btn-info">Add Stocks</button>
                    <button class="px-1 pt-1 pb-1 btn btn-primary">Update</button>
                    <button class="px-1 pt-1 pb-1 btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> 
</div>

{{ $products->links() }}

@endsection
