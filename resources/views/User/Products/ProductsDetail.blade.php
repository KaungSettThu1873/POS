@extends('User.Layouts.Master')

@section('title')
    <title> Detail </title>
@endsection

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-3 mb-30">
                <img src="{{ asset('storage/' . $Products->image) }}" class="w-100 h-100" />
            </div>

            <div class="col-lg-9 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3 class="d-inline">{{ $Products->name }} </h3> <span class="text-muted">( {{ $Products->category_name }}
                        )</span>
                    <input type="hidden" id="UserId" value="{{ Auth::user()->id }}" />
                    <input type="hidden" id="ProductId" value="{{ $Products->id }}" />

                    <div class="d-flex mb-3">
                        {{-- <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div> --}}
                        <span class="pt-1 text-dark "><i class="fa-solid fa-eye "
                                style="margin-right: 5px"></i>{{ $Products->view_count + 1 }}</span>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $Products->price }} Kyats</h3>
                    <p class="mb-4">{{ $Products->description }}y</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id='Count'
                                class="form-control bg-dark text-white  border-0 text-center ms-1 me-1" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id='BtnAddToCart' class="btn btn-warning px-3"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">


                    @foreach ($AllPizza as $item)
                        <div class="product-item bg-light data ">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $item->image) }}"
                                    style="height: 200px;" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square BtnCart" href="#"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('User#ProductsDetail', $item->id) }}"><i
                                            class="fa-solid fa-magnifying-glass"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $item->name }} </a>
                                <span class="text-muted">( {{ $item->category_name }} )</span>

                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $item->price }} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    {{-- <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small> --}}

                                    <span class="pt-1 text-dark "><i class="fa-solid fa-eye "
                                            style="margin-right: 5px"></i>{{ $item->view_count + 1 }}</span>
                                    <input type="hidden" class="productId1" value="{{ $item->id }}" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>





        </div>
    </div>
    <!-- Products End -->
@endsection

@section('ScriptSource')
    <script>
        $(document).ready(function() {

            $.ajax({
                type: 'get',
                url: "/User/AjaxViewCount",
                data: {
                    'ProductId': $('#ProductId').val()
                },
                dataType: 'json',

            });

            $('#BtnAddToCart').click(function() {

                $source = {
                    'UserId': $('#UserId').val(),
                    'ProductId': $('#ProductId').val(),
                    'CartQty': $('#Count').val()
                }

                $.ajax({
                    type: 'get',
                    url: "/User/AddToCart",
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "/User/Home";
                        }
                    }
                });

            })

            $('.BtnCart').click(function() {
                $parentsNode = $(this).parents('.data');
                $productId = $parentsNode.find('.productId1').val();


                $source = {
                    'UserId': $('#UserId').val(),
                    'ProductId': $productId,
                    'CartQty': 1
                }
                console.log($source);

                $.ajax({
                    type: 'get',
                    url: "/User/AddToCart",
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "/User/Home";
                        }
                    }
                });

            })




        })
    </script>
@endsection
