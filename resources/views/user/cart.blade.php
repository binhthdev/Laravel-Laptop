<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>CyberMart | My Cart</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="user/assets/imgs/theme/favicon.ico" />
    <link rel="stylesheet" href="user/assets/css/main.css" />
    <link rel="stylesheet" href="user/assets/css/custom.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    @include('user.header')
    @include('user.mobile_header')

    <main class="main">
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    @if ($cartData->isEmpty())
                    <div class="text-center">
                        <h1>Cart is empty</h1>
                        <img style="width: 25%" src="/user/assets/imgs/empty-cart-img.png" alt="" />
                    </div>
                    @else
                    <?php $totalPrice = 0; ?>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartData as $cart)
                                    <tr data-cart-id="{{ $cart->id }}">
                                        <td class="image product-thumbnail"><img
                                                src="products_images/{{$cart->image}}" alt="product_image" /></td>
                                        <td class="product-des product-name px-5">
                                            <h5 class="product-name px-5"><a
                                                    href="{{url('product_details', $cart->product_id)}}">{{$cart->product_title}}</a>
                                            </h5>
                                        </td>
                                        <td class="price" data-title="Price"
                                            data-unit-price="{{ $cart->price / $cart->quantity }}">
                                            <span>${{ number_format($cart->price / $cart->quantity, 2) }}</span>
                                        </td>
                                        <td class="text-center" data-title="Stock">
                                            <div class="detail-qty border radius m-auto">
                                                <form action="{{route('update.cart.quantity')}}" method="POST"
                                                    class="quantity-form">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{$cart->id}}" />
                                                    <input type="hidden" name="quantity" value="{{$cart->quantity}}" />
                                                    <div class="quantity-controls">
                                                        <span class="minus">-</span>
                                                        <span class="qty-val">{{$cart->quantity}}</span>
                                                        <span class="plus">+</span>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>${{ number_format($cart->price, 2) }}</span>
                                        </td>
                                        <td class="action" data-title="Remove"><a onclick="confirmation(event)"
                                                href="{{url('remove-product-from-cart',$cart->id)}}"
                                                class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                    <?php $totalPrice += $cart->price ?>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="text-end"><a href="{{route('user.clear_cart')}}"
                                                class="text-muted"> <i class="fi-rs-cross-small"></i> Clear Cart</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">
                            <a class="btn " href="{{route('user.shop')}}"><i
                                    class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                            <a href="{{route('user.checkout')}}" class="btn"> <i
                                    class="fi-rs-box-alt mr-10"></i> Proceed to Checkout(${{$totalPrice}})</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12"></div>
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span
                                                                class="font-xl fw-900 text-brand">${{
                                                                number_format($totalPrice, 2) }}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{route('user.checkout')}}" class="btn"> <i
                                            class="fi-rs-box-alt mr-10"></i> Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    @include('user.footer')

    <!-- Vendor JS-->
    <script src="user/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="user/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="user/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="user/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="user/assets/js/plugins/slick.js"></script>
    <script src="user/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="user/assets/js/plugins/wow.js"></script>
    <script src="user/assets/js/plugins/jquery-ui.js"></script>
    <script src="user/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="user/assets/js/plugins/magnific-popup.js"></script>
    <script src="user/assets/js/plugins/select2.min.js"></script>
    <script src="user/assets/js/plugins/waypoints.js"></script>
    <script src="user/assets/js/plugins/counterup.js"></script>
    <script src="user/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="user/assets/js/plugins/images-loaded.js"></script>
    <script src="user/assets/js/plugins/isotope.js"></script>
    <script src="user/assets/js/plugins/scrollup.js"></script>
    <script src="user/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="user/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="user/assets/js/plugins/jquery.elevatezoom.js"></script>

    <!-- Template  JS -->
    <script src="user/assets/js/main.js?v=3.3"></script>
    <script src="user/assets/js/shop.js?v=3.3"></script>

    <script>
        $(document).ready(function () { 
            function updateCartTotal() {
                let total = 0;
                $('table.shopping-summery tbody tr[data-cart-id]').each(function () {
                    let $totalSpan = $(this).find('td.text-right span');
                    if ($totalSpan.length) {
                        let val = parseFloat($totalSpan.text().replace('$', ''));
                        if (!isNaN(val)) total += val;
                    }
                });
                $('.cart_total_amount span').text(`$${total.toFixed(2)}`);
                $('.cart-action a[href*="checkout"]').html(`<i class="fi-rs-box-alt mr-10"></i> Proceed to Checkout($${total.toFixed(2)})`);
            }

            $('.quantity-controls .plus, .quantity-controls .minus').click(function () {
                let $tr = $(this).closest('tr');
                let $qtySpan = $(this).siblings('.qty-val');
                let $inputQty = $(this).closest('form').find('input[name="quantity"]');
                let $priceTd = $tr.find('td.price');
                let $totalPriceTd = $tr.find('td.text-right span');

                let currentQty = parseInt($qtySpan.text());
                let unitPrice = parseFloat($priceTd.data('unit-price'));

                if ($(this).hasClass('plus')) {
                    currentQty++;
                } else if ($(this).hasClass('minus') && currentQty > 1) {
                    currentQty--;
                }

                // Cập nhật UI số lượng tạm thời
                $qtySpan.text(currentQty);
                $inputQty.val(currentQty);

                let newTotal = (unitPrice * currentQty).toFixed(2);
                $totalPriceTd.text(`$${newTotal}`);

                updateCartTotal();

                // Gửi AJAX cập nhật lên server
                let cartId = $tr.data('cart-id');
                $.ajax({
                    url: "{{ route('update.cart.quantity') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cart_id: cartId,
                        quantity: currentQty
                    },
                    success: function (response) {
                        if (response.success) {
                            console.log('Cập nhật thành công:', response.message);
                            updateCartTotal();
                        } else {
                            alert(response.message);
                            location.reload();
                        }
                    },
                    error: function (xhr) {
                        let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Lỗi khi cập nhật số lượng.';
                        alert(msg);
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>

</html>
