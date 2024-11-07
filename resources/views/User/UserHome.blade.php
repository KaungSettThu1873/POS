@extends('User.Layouts.Master')

@section('title')
    <title> Home </title>
@endsection

@section('content')
    <div class="container-fluid mx-0 px-0">
     <div class="col-12">
        <div class="row px-xl-5 mx-0 px-0">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-3 col-sm-12 col-12 mx-0 px-0">
                <!-- Price Start -->
                <h5 class="section-title  text-uppercase mb-3 text-center">All Category </h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">

                            <a href="{{ route('User#Home') }}" class="text-decoration-none text-dark">All Pizza</a>
                        </div>
                        @foreach ($Categories as $item)
                            <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('Category#Filter', $item->id) }}" class=" text-decoration-none text-dark">
                                    {{ $item->name }} </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->


                {{-- <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div> --}}
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-9 col-sm-12 col-12 data mx-0 px-0">
                <div class="row pb-3 mx-0 px-0">
                    <div class="col-lg-9 col-md-9 col-sm-7 col-7 pb-1">

                        <a href="{{route('Cart#Page',Auth::user()->id)}}" class="btn px-0 ml-3">
                            <button type="button" class="btn btn-dark  position-relative">
                                <i class="fas fa-shopping-cart text-warning fs-4"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-white bg-dark">
                            {{count($Cart)}}
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                              </button>
                        </a>

                        <a href="{{route('User#OrderList',Auth::user()->id)}}" class="btn px-0 ml-3">
                            <button type="button" class="btn btn-dark  position-relative">
                                <i class="fa-solid fa-list text-warning fs-4"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-white bg-dark">
                            {{count($OrderList)}}
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                              </button>


                        </a>

                        <input type="hidden" class="userId" value="{{$User['id']}}" />

                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-5 col-5">
                        <select class="form-control" name="sort" id="sorting">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>

                    @if (count($Products) != 0)
                        <a href="detail.html">
                            <div class="row" id='product-container'>

                                    @foreach ($Products as $item)

                                        <div class="col-lg-3 col-md-6 col-sm-6 pb-1 data1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden">
                                                    <img class="img-fluid w-100" style="height: 200px;"
                                                        src="{{ asset('storage/' . $item->image) }}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square BtnCart " href="#" ><i
                                                                class="fa fa-shopping-cart "></i></a>
                                                        <a class="btn btn-outline-dark btn-square"
                                                            href="{{ route('User#ProductsDetail', $item->id) }}"><i
                                                                class="fa-solid fa-magnifying-glass"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate"
                                                        href=""><span style="overflow: hidden !important;">{{ $item->name }}</span></a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>{{ $item->price }} Kyats</h5>
                                                        <h6 class="text-muted ml-2"></h6>

                                                    </div>
                                                    {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <input value="{{$item->id}}" type="hidden" class="productId1" />

                                        </div>

                                    @endforeach



                            </div>
                        </a>

                    @else
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <h4 class="text-dark text-center mt-5"> There is no products! </h4>

                    </div>
                    @endif


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
     </div>
    </div>
@endsection

@section('ScriptSource')
    <script>
        $(document).ready(function(){

            $('#sorting').change(function() {
                $sorting  = $('#sorting').val();
                console.log($sorting);
                if($sorting == 'asc') {
                    $.ajax({
                            type : 'get' ,
                            url: "/User/AjaxProductsList",
                            data: {'status':$sorting},
                            dataType : 'json',
                            success: function(response) {
                                $lists = '' ;
                                for($i = 0 ;  $i<response.length;$i++) {
                                    $lists +=
                                    `
                                                <div class="col-lg-3 col-md-6 col-sm-6 pb-1 data1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden">
                                                    <img class="img-fluid w-100" style="height: 200px;"
                                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square BtnCart " href="#" ><i
                                                                class="fa fa-shopping-cart "></i></a>
                                                        <a class="btn btn-outline-dark btn-square"
                                                            href="{{ url('/ProductsDetail/${response[$i].id}') }}"><i
                                                                class="fa-solid fa-magnifying-glass"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate"
                                                        href=""><span style="overflow: hidden !important;"> ${response[$i].name}</span></a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price}  Kyats</h5>
                                                        <h6 class="text-muted ml-2"></h6>

                                                    </div>
                                                    {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <input value="${response[$i].price}" type="hidden" class="productId1" />

                                        </div>
                                    `

                                }
                                $('#product-container').html($lists);
                            }
                            })
                } else if($sorting == 'desc') {

                    $.ajax({
                            type : 'get' ,
                            url: "/User/AjaxProductsList" ,
                            data: {'status':$sorting},
                            dataType : 'json',
                            success: function(response) {
                                $lists ='';
                                for($i = 0 ;  $i<response.length;$i++){
                                        $lists +=
                                    `
                                     <div class="col-lg-3 col-md-6 col-sm-6 pb-1 data1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden">
                                                    <img class="img-fluid w-100" style="height: 200px;"
                                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square BtnCart " href="#" ><i
                                                                class="fa fa-shopping-cart "></i></a>
                                                        <a class="btn btn-outline-dark btn-square"
                                                               href="{{ url('/ProductsDetail/${response[$i].id}') }}"><i
                                                                class="fa-solid fa-magnifying-glass"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate"
                                                        href=""><span style="overflow: hidden !important;"> ${response[$i].name}</span></a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price}  Kyats</h5>
                                                        <h6 class="text-muted ml-2"></h6>

                                                    </div>
                                                    {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <input value="${response[$i].price}" type="hidden" class="productId1" />

                                        </div>
                                    `

                                }

                                $('#product-container').html($lists);
                            }
                            })
                }

            });


            $('.BtnCart').click(function() {
            $parentsNode = $(this).parents('.data');
            $parentsNode2 = $(this).parents('.data1');
            $productId = $parentsNode2.find('.productId1').val();

            $userId= $parentsNode.find('.userId').val();

            $source = {
                'UserId' : $userId,
                'ProductId' : $productId,
                'CartQty'   :   1
            }
            console.log($source);

            $.ajax({
                    type : 'get' ,
                    url: "/User/AddToCart",
                    data: $source,
                    dataType : 'json',
                    success: function(response) {
                        if(response.status == 'success') {
                            window.location.href = "/User/Home";
                        }
                    }
                    });

        })
        })
    </script>
@endsection
