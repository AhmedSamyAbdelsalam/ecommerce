<div class="col-lg-4">
    <div class="card border-0 rounded-0 p-lg-4 bg-light">
        <div class="card-body">
            <h5 class="text-uppercase mb-4">Cart total</h5>
            <ul class="list-unstyled mb-0">
                @if($cart_total != 0 )
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="text-uppercase small font-weight-bold">Subtotal</strong>
                        <span class="text-muted small">
                            ${{$cart_subtotal}}
                        </span>
                    </li>
                    @if(session()->has('coupon'))
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small fw-bold">Coupons <small>{{getNumbers()->get('discount_code')}}</small></strong>
                            <span class="text-muted small">${{$cart_discount}}</span>
                        </li>
                    @endif
                    @if(session()->has('shipping'))
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small fw-bold">Shipping <small>{{getNumbers()->get('shipping_code')}}</small></strong>
                            <span class="text-muted small">${{$cart_shipping}}</span>
                        </li>
                    @endif
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4">
                        <strong class="text-uppercase small font-weight-bold">Tax</strong>
                        <span>${{$cart_tax}}</span>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4">
                        <strong class="text-uppercase small font-weight-bold">Total</strong>
                        <span>${{$cart_total}}</span>
                    </li>
                @else
                    <li class="d-flex align-items-center justify-content-between mb-4">
                        <span>Your cart is empty!</span>
                    </li>
                @endif
{{--                <li>--}}
{{--                    <form action="#">--}}
{{--                        <div class="input-group mb-0">--}}
{{--                            <input class="form-control" type="text" placeholder="Enter your coupon">--}}
{{--                            <button class="btn btn-dark btn-sm w-100" type="submit"><i--}}
{{--                                    class="fas fa-gift me-2"></i>Apply coupon--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</div>
