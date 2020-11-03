@extends('template.main')

@section('title', 'Cashier')

@section('nav')
    @include('template.header')
    @include('template.adminnav', ['active'=>''])
@endsection

@section('main_id', 'cashier')

@section('body')

    <div class="clearfix px-1">
        <h3 class="float-left">Customer Cart</h3>
        <h3 class="float-right">Total Amout : @{{ total }}</h3>
    </div>

    <div class="cart-container px-1 pt-1 pb-1">

        <div class="cart-table table-responsive bg-light">
            <table class="table table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>SubTotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    <tr v-for="(cart,i) in carts" v-on:click="select(cart)">
                        <td>@{{ cart.code }}</td>
                        <td>@{{ cart.name }}</td>
                        <td>@{{ cart._quantity }}</td>
                        <td>@{{ cart.price }}</td>
                        <td>@{{ cart.price*cart._quantity }}</td>
                        <td>
                            <button v-on:click="remove(i)" class="btn btn-danger pt-0 pb-0">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row cart-info">

            <div class="col-md-6 form">
                <form action="{{ route('process') }}" method="POST">

                        @csrf

                        <input 
                            type="hidden" 
                            v-for="(cart,i) in carts" 
                            :name="`carts[${i}][id]`"
                            :value="cart.id">
                        <input 
                            type="hidden"
                            v-for="(cart, i) in carts" 
                            :name="`carts[${i}][quantity]`"
                            :value="cart._quantity">

                        <label for="query">Item Code</label>
                        <div class="search">
                            <input 
                                type="search" 
                                name="query" 
                                id="query" 
                                class="form-control" 
                                placeholder="type the name to search, or enter the product code." 
                                autocomplete="off" 
                                v-model="query" />
                            <div id="suggestions" class="d-none">
                                <div class="item" v-if="searching">
                                    Searching : @{{ query }}
                                </div>
                                <div class="item" v-if="notfound">
                                    Product not found : @{{ query }}
                                </div>
                                <div v-on:mouseover="selected=suggestion" v-on:click="select(suggestion)" class="item" v-for="suggestion in suggestions">
                                    <b>Name : @{{ suggestion.name }}</b><br/>
                                    Code : @{{ suggestion.code }}
                                </div>
                            </div>
                        </div>

                        <label for="quantity">Quantity</label>
                        <input type="number" v-model="quantity" :max="selected.quantity" min="1" name="quantity" id="quantity" class="form-control" value="1">

                        <div class="row" style="margin: 4px 0px 0px 0px">
                            <button type="button" class="col-md-6 btn btn-primary" v-on:click="addToCart()">Add to cart</button>
                            <button class="col-md-6 btn btn-success">Process</button>
                        </div>

                </form>
            </div>

            <div class="col-md-6">
                <h6><b>Code : </b> @{{ selected.code }}</h6>
                <h6><b>Name : </b> @{{ selected.name }}</h6>
                <h6><b>Price : </b> @{{ selected.price }}</h6>
                <h6><b>Stocks : </b> @{{ selected.quantity }}</h6>
                <h6><b>Description : </b> @{{ selected.description }}</h6>

            </div>
        </div>

    </div>

@endsection


@section('script')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection