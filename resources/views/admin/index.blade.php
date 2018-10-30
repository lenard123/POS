@extends('template.main')

@section('title', 'Home')

@section('nav')

    @include('template.header')
    @include('template.adminnav', ['active' => 'inventory'])

@endsection

@section('body')

@include('template.success')
@include('template.errors')

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
                    <a class="pt-0 pb-0 btn btn-info" href="{{ route('addstock', ['id'=>$product->id]) }}">Add Stocks</a>
                    <a class="pt-0 pb-0 btn btn-primary" href="{{ route('updateproduct', ['id'=>$product->id]) }}">Update</a>
                    <button class="pt-0 pb-0 btn btn-danger delete" id="{{ $product->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> 
</div>

{{ $products->links() }}

@component('template.modal', ['id'=>'delete_modal'])

    @slot('header')
        Delete Product?
    @endslot

    Are you sure to delete this product?

    <form id="delete_form" method="POST">
        @method('DELETE')
        @csrf
        <div class="form-group">
            <label for="password">
                <strong>For security reason</strong>
            </label>
            <input type="password" name="password" class="form-control" id="password" required placeholder="Enter your password">
        </div>
        <input type="submit" class="d-none">
    </form>


    @slot('footer')
        <button class="btn btn-danger" onclick="$('#delete_form').submit()">Delete</button>
        <button class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
    @endslot
@endcomponent

@endsection



@section('script')

<script>
$('.delete').click(function(){
    var action = '{{ route("addproduct") }}/'+this.id;
    $('#delete_form').attr('action', action);
    $('#delete_modal').modal();
});
</script>

@endsection