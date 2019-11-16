@extends('fontend.layouts.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="/fontend/styles/bootstrap4/bootstrap.min.css">
    <link href="/fontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/fontend/styles/cart_styles.css">
    <link rel="stylesheet" type="text/css" href="/fontend/styles/cart_responsive.css">
@endsection
@section('content')
    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($all as $product)
                                    {{-- expr --}}
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image">
                                      {{--   @foreach ($product->options as $key=> $option)
                                        @if ($key==0) --}}
                                             <img src="/storage/{{ $product->options->image }}" alt="">
                                       {{--  @endif

                                        @endforeach --}}

                                    </div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">{{ $product->name }}</div>
                                        </div>
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Color</div>
                                            <div class="cart_item_text"><span style="background-color:#999999;"></span>Silver</div>
                                        </div>
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div>
                                            <div class="cart_item_text">{{ $product->qty }}</div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Price</div>
                                            <div class="cart_item_text">{{ number_format($product->price) }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Total</div>
                                            <div class="cart_item_text">{{ number_format($product->qty*$product->price) }}</div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Order Total -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">{{\Gloudemans\Shoppingcart\Facades\Cart::total()}}</div>
                            </div>
                        </div>

                       {{--  <div class="cart_buttons">
                            <button type="button" class="button cart_button_clear">Add to Cart</button>
                            <button type="button" class="button cart_button_checkout">Add to Cart</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="/fontend/images/send.png" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="#" class="newsletter_form">
                                <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                                <button class="newsletter_button">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/fontend/js/jquery-3.3.1.min.js"></script>
    <script src="/fontend/styles/bootstrap4/popper.js"></script>
    <script src="/fontend/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="/fontend/plugins/greensock/TweenMax.min.js"></script>
    <script src="/fontend/plugins/greensock/TimelineMax.min.js"></script>
    <script src="/fontend/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="/fontend/plugins/greensock/animation.gsap.min.js"></script>
    <script src="/fontend/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="/fontend/plugins/easing/easing.js"></script>
    <script src="/fontend/js/cart_custom.js"></script>
@endsection
