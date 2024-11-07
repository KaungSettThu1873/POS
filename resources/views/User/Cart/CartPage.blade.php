@extends('User.Layouts.Master')

@section('title')
    <title>Cart</title>
@endsection

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($Cart as $item)
                            <tr>
                                <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                    {{ $item->product_name }}</td>
                                <input type="hidden" id='uniqueId' value="{{ $item->id }}" />
                                <input type="hidden" id='productId' value="{{ $item->product_id }}">
                                <input type="hidden" id='userId' value="{{ $item->user_id }}" />
                                <td class="align-middle" id='price'>{{ $item->product_price }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus  ">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text"
                                            class="form-control form-control-sm text-dark border-0 text-center"
                                            id="quantity" value="{{ $item->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus ">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id='Total'>{{ $item->product_price * $item->quantity }}</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $TotalPrice }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id='finalTotal'>{{ $TotalPrice + 3000 }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 btn-cart">Proceed To
                            Checkout</button>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 " id="ClearCart">Clear
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('ScriptSource')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find('#price').text() * 1;
                $quantity = $parentNode.find('#quantity').val() * 1;
                $Total = $price * $quantity;
                $parentNode.find('#Total').html($Total);
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += $(row).find('#Total').text() * 1;
                })
                $('#subTotal').html($totalPrice);
                $('#finalTotal').html($totalPrice + 3000);

            })





            $('.btn-minus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find('#price').text();
                $quantity = $parentNode.find('#quantity').val();
                $Total = $price * $quantity;
                $parentNode.find('#Total').html($Total)
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += $(row).find('#Total').text() * 1;
                })
                $('#subTotal').html($totalPrice);
                $('#finalTotal').html($totalPrice + 3000);


            })




        })
    </script>
    <script>
        $('.btn-cart').click(function() {
            $orderList = [];

            $random = Math.floor(Math.random() * 1059211);

            $('#dataTable tbody tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('#userId').val(),
                    'product_id': $(row).find('#productId').val(),
                    'quantity': $(row).find('#quantity').val(),
                    'total': $(row).find('#Total').text() * 1,
                    'order_code': 'POS' + $random * 1,
                })
            })


            $.ajax({
                type: 'get',
                url: "/User/Order",
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'true') {
                        window.location.href = "/User/Home";
                    }
                }
            });


        })

        //Clear Cart
        $('#ClearCart').click(function() {
            $('#dataTable tbody tr').remove();
            $totalPrice = 0;
            $('#subTotal').html($totalPrice);
            $('#finalTotal').html($totalPrice + 3000);

            $.ajax({
                type: 'get',
                url: "/User/ClearCart",
                dataType: 'json',
            });

        })

        // Clear current Cart
        $('.btn-remove').click(function() {
            $parentNode = $(this).parents('tr');
            $productId = $parentNode.find('#productId').val();
            $uniqueId = $parentNode.find('#uniqueId').val();

            $.ajax({
                type: 'get',
                url: "/User/CurrentClearCart",
                data: {
                    'productId': $productId,
                    'uniqueId': $uniqueId
                },
                dataType: 'json',

            });
            $parentNode.remove();

            $totalPrice = 0;
            $('#dataTable tr').each(function(index, row) {
                $totalPrice += $(row).find('#Total').text() * 1;
            })
            $('#subTotal').html($totalPrice);
            $('#finalTotal').html($totalPrice + 3000);
        })
    </script>
@endsection
