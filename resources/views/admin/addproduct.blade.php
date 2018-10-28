@extends('template.main')

@section('title', 'Add Product')

@section('nav')
    
    @include('template.header')
    @include('template.adminnav', ['active'=>'addproduct'])

@endsection

@section('body')
<h1>Add Product</h1>
<hr/>
<form method="POST" action="{{ route('addproduct') }}">

@include('template.success')
@include('template.errors')
@csrf

<div class="form-group">
    <label for="code">Product Code</label>
    <input type="text" name="code" id="code" class="form-control" required value="{{ old('code') }}">
</div>

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" required>
</div>

<div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category_id" required>
        <option value="0" selected disabled>-- Select Category -- </option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

<div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" value="{{ old('quantity') }}" name="quantity" id="quantity" class="form-control" required>
</div>

<div class="form-group">
    <label for="price">Price</label>
    <input type="number" value="{{ old('price') }}" name="price" id="price" class="form-control" required step="0.01">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Add Product</button>
</div>

</form>
@endsection
