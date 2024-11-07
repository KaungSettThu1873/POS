@extends('User.Layouts.Master')

@section('title')
    <title> Order List </title>
@endsection

@section('content')
        <!-- Cart Start -->
    <div class="container-fluid  " style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8  col-md-8 col-sm-12 col-12 offset-lg-2  offset-md-2 offset-sm-0  offset-0 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    @foreach ($OrderList as $item)
                        <tr>
                            <td class="align-middle" >{{$item->created_at}}</td>
                            <td class="align-middle" >{{$item->order_code}}</td>
                            <td class="align-middle" >{{$item->total_price}}</td>
                            <td class="align-middle" >
                                @if ($item->status == 0)
                                    <span class="text-warning fw-bold"> Pending </span>
                                @elseif ($item->status == 1)
                                    <span class="text-success fw-bold"> Success </span>
                                @elseif ($item->status == 2)
                                    <span class="text-danger fw-bold"> Reject </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-2"> {{ $OrderList->links()}} </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection










