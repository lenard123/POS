@extends('template.main')


@section('title', 'Add Stocks')


@section('nav')

    @include('template.header')
    @include('template.adminnav', ['active' => 'inventory'])

@endsection


@section('body')

    <div class="row">

        <div class="col-md-4">
            <h1>Add Stocks</h1>
            <hr/>
            <form action="" method="POST">
                
                @include('template.success')
                @include('template.errors')
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="hidden" name="quantity" id="input_quantity" type="number" required value="0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="btn btn-primary" onclick="addStock(-1)">
                                <b>-</b>
                            </span>
                        </div>
                        <div class="form-control text-center">
                            <b><span id="quantity">0</span></b>
                        </div>
                        <div class="input-group-append">
                            <span class="btn btn-primary" onclick="addStock(1)">
                                <b>+</b>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <a href="{{ route('admin') }}" class="btn btn-outline-secondary">Back</a>
                </div>

            </form>     
        </div>

        <div class="col-md-6">

            <h1>Product Information</h1>
            <hr/>

            <table class="table">
                <tr>
                    <td><h5>Name</h2></td>
                    <td><h6>{{ $product->name }}</h3></td>
                </tr>
                <tr>
                    <td><h5>Product Code</h5></td>
                    <td><h6>{{ $product->code }}</h6></td>
                <tr>
                    <td><h5>Category</h3></td>
                    <td><h6>{{ $product->category->name }}</h4>
                </td>
                <tr>
                    <td><h5>Description</h5></td>
                    <td><h6>{{ $product->description }}</h6></td>
                </tr>
                <tr>
                    <td><h5>Quantity</h5></td>
                    <td><h6>{{ $product->quantity }}</h6></td>
                </tr>
                <tr>
                    <td><h5>Price</h5></td>
                    <td><h6>{{ $product->price }}</h6></td>
                </tr>
            </table>

        </div>

    </div>

@endsection


@section('script')
<script>

var addStock = function (n) {
    var quantity = parseInt($('#input_quantity').val()) + n;
    if (quantity < 0)
        quantity = 0;
    $('#input_quantity').val(quantity);
    $('#quantity').html(quantity);
}

addStock(0);

</script>
@endsection
 