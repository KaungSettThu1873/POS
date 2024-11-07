@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Order Lists Detail </title>
@endsection

@section('content')

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div><a href="{{route('Order#List')}}" class=" text-decoration-none text-dark fs-5 "><i class="fa-solid fa-arrow-left text-dark me-2" ></i>Back</a></div>
                    <div class="col-md-12">
                        <div class="card col-lg-6 offset-3 ">
                            <div class="card-header"><h4 class="text-dark">Order Detail Information</h></div>
                            <div class="card-body">
                                    <div class="row mb-2">
                                            <span class="col-3"><i class="fa-solid fa-user me-2"></i>Name </span>-
                                            <span class="col-6">{{$OrderLists[0]->user_name}}</span>
                                    </div>
                                    <div class="row mb-2">
                                        <span class="col-3"><i class="fa-solid fa-barcode me-2"></i>Order Code </span>-
                                        <span class="col-6">{{$OrderLists[0]->order_code}}</span>
                                    </div>
                                    <div class="row mb-2">
                                        <span class="col-3"><i class="fa-solid fa-clock me-2"></i>Order Date </span>-
                                        <span class="col-6">{{ $OrderLists[0]->created_at->format('d-m-Y | H:i:s a')}}</span>
                                    </div>
                                    <div class="row mb-2">
                                        <span class="col-3"><i class="fa-solid fa-money-bill-wave me-2"></i>Total </span>-
                                        <span class="col-6">{{$Order->total_price.' Kyats  '}}<small class="text-muted">(included Delivery Charges)</small></span>
                                    </div>


                            </div>
                        </div>
                        <div class="col-lg-10 offset-1 table-responsive mb-5 mt-3">
                            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Order Date</th>
                                        <th>Quantity</th>
                                        <th>Amounts</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle "  >
                                    @foreach ($OrderLists as $item)
                                        <tr >
                                            <td class="align-middle col-2"  > <img src="{{asset('storage/'.$item->product_image)}}" style="height:150px !important"  alt='...'/></td>
                                            <td class="align-middle" >{{ $item->product_name}}</td>
                                            <td class="align-middle" >{{ $item->created_at->format('d-m-Y | H:i:s a')}}</td>
                                            <td class="align-middle" > {{ $item->quantity}} </td>
                                            <td class="align-middle" > {{ $item->total}} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{$OrderLists->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
@endsection



