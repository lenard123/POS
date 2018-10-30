@extends('template.main')

@section('title', 'Update Product')

@section('nav')
    
    @include('template.header')
    @include('template.adminnav', ['active'=>'inventory'])

@endsection

@section('body')
<h1>Update Product</h1>
<hr/>
<form method="POST">

@include('template.success')
@include('template.errors')
@csrf
@method('PUT')

<div class="form-group">
    <label for="code">Product Code</label>
    <input type="text" name="code" id="code" class="form-control" placeholder="XXX-XXX-XXX" required value="{{ $product->code }}">
</div>

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" value="{{ $product->name }}" name="name" id="name" class="form-control" required>
</div>

<div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category_id" required>
        <option value="0" disabled>-- Select Category -- </option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected':'' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="price">Price</label>
    <input type="number" value="{{ $product->price }}" name="price" id="price" class="form-control" required step="0.01">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description">{{ $product->description }}</textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Update Product</button>
    <a href="{{ route('admin') }}" class="btn btn-outline-secondary">Back</a>
</div>

</form>
@endsection
