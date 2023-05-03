@extends('client_layout.master')

@section('title')
    Cart
@endsection

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    @if(Session::has('topCart') && Session::get('topCart') !== [])
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>frontend/images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach(Session::get('topCart') as $item)
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ asset('storage/product_images/' . $item['product_image']) }}" alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="#">
                                                {{ $item['product_name'] }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>$ {{ number_format($item['product_price'], 1) }}</p>
                                        </td>
                                        <td class="quantity-box">
                                            <form action="{{ route("client.cart.updateQty", ["product" => $item["item"]]) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <input type="number" size="4" name="qty" value="{{ $item['qty'] }}" min="1" step="1" class="c-input-text qty text">
                                                <br>
                                                <input type="submit" class="btn btn-dark mt-2" value="Update">
                                            </form>
                                        </td>
                                        <td class="total-pr">
                                            <p>$ {{ number_format($item['product_price'] * $item['qty'], 1) }}</p>
                                        </td>
                                        <td class="remove-pr">
                                            <a href="{{ route("client.cart.removeItem", ["product" => $item["item"]]) }}">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                            <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="button">Apply Coupon (TODO)</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>

                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> $ {{ Session::has('cart') ? number_format(Session::get('cart')->totalPrice, 1) : 0 }} </div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="{{ route('client.cart.checkout') }}" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    @else
        <div class="cart-box-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Your cart is empty.</h1>
                        <a href="{{ route("client.shop.index") }}">
                            <button class="btn btn-dark mb-3">Back to shop</button>
                        </a>
                    </div>
                </div>
        </div>
    @endif
    <!-- End Cart -->
@endsection
