@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title>Order Lists</title>
@endsection

@section('content')

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Order Lists</h2>

                                </div>
                            </div>
                        </div>

                        <form action="{{ route('Order#Status')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <span class="fw-bold ms-5 text-dark col-2 ps-5 pt-1 ">Order Status</span>
                                    <select name="statusValue" class="form-control d-inline me-2 " >
                                        <option value='' >All</option>
                                        <option value="0" @if(request('statusValue')=== 0) selected @endif>Pending </option>
                                        <option value="1" @if(request('statusValue')== 1) selected @endif>Accept</option>
                                        <option value="2" @if(request('statusValue')== 2) selected @endif>Reject</option>
                                    </select>
                                    <button  type="submit" class="btn w-25 btn-dark text-white Btn-Search">Search</button>
                            </div>
                        </form>

                        <div class="col-lg-10 offset-1 table-responsive mb-5 mt-3">
                            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Order Date</th>
                                        <th>Order Code</th>
                                        <th>Amounts</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle " id="dataList" >
                                @foreach ($Order as $item)
                                    <tr>
                                        <input type="hidden" class="orderId" value="{{$item->id}}" />
                                        <td class="align-middle" >{{ $item->user_id}}</td>
                                        <td class="align-middle" >{{ $item->user_name}}</td>
                                        <td class="align-middle" >{{ $item->created_at->format('d-m-Y | H:i:s a')}}</td>
                                        <td class="align-middle" > <a href="{{ route('Order#DetailList',$item->order_code)}}" class="text-decoration-none text-primary"> {{ $item->order_code}} </a> </td>
                                        <td class="align-middle amounts"  >{{ $item->total_price}}</td>
                                        <td class="align-middle" >
                                            <select class="form-control statusChange">
                                                <option value="0" @if ($item->status == 0) selected @endif>Pending </option>
                                                <option value="1" @if ($item->status == 1) selected @endif>Accept</option>
                                                <option value="2" @if ($item->status == 2) selected @endif>Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            {{-- <div class="mt-2"> {{ $OrderList->links()}} </div> --}}
                        </div>


                        <!-- END DATA TABLE -->
                    {{-- @else --}}
                        {{-- <h4 class="text-dark text-center mt-5"> not match any data ! </h4>
                    @endif --}}

                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->

@endsection

@section('Script')
        <script>
            $(document).ready(function(){
                // Order Status
                // $('#OrderStatus').change(function(){
                //     $OrderStatus = $('#OrderStatus').val();

                //     $.ajax({
                //         type: 'get',
                //         url: "http://127.0.0.1:8000/OrderStatus",
                //         data: {
                //             'OrderStatus' : $OrderStatus
                //         },
                //         dataType: 'json',
                //         success: function(response) {

                //                      $lists='';
                //                 for($i=0;$i<response.length;$i++) {

                //                     $Month=['1','2','3','4','5','6','7','8','9','10','11','12'];
                //                     $Date = new Date(response[$i].created_at);
                //                     $hours = $Date.getHours();
                //                     $minutes = $Date.getMinutes();
                //                     $second  = $Date.getSeconds();
                //                     $ampm = $hours >= 12 ? 'PM' : 'AM';
                //                     // $hours = $hours % 12;
                //                     // $hours = $hours ? $hours : 12; // the hour '0' should be '12'
                //                     $minutes = $minutes < 10 ? '0' + $minutes : $minutes;
                //                     $time = $hours + ':' + $minutes + ':' +$second + ' ' + $ampm;

                //                    $FinalDate=$Date.getDate()+'-'+$Month[$Date.getMonth()]+'-'+$Date.getFullYear()+' | '+$time;



                //                     $lists += `
                //                          <tr>
                //                         <td class='align-middle' >${response[$i].user_id}</td>
                //                         <td class='align-middle' > ${response[$i].user_name}</td>
                //                         <td class='align-middle' > ${$FinalDate}</td>
                //                         <td class='align-middle' > ${response[$i].order_code}</td>
                //                         <td class='align-middle' > ${response[$i].total_price}</td>
                //                         <td class='align-middle' >
                //                             <select class="form-control">
                //                                 <option value='0' ${response[$i].status == 0 ? 'selected' : ''}>Pending</option>
                //                                 <option value='1' ${response[$i].status == 1 ? 'selected' : ''}>Accept</option>
                //                                 <option value='2' ${response[$i].status == 2 ? 'selected' : ''}>Reject</option>
                //                             </select>
                //                         </td>
                //                     </tr>

                //                 `};
                //                 $('#dataList').html($lists);
                //              }
                //     });
                // });
                $('.statusChange').change(function(){
                    $currentStatus = $(this).val();
                    $parentNodes = $(this).parents('tr');
                    $orderId = $parentNodes.find('.orderId').val();

                    $data = {
                        'status' : $currentStatus,
                        'orderId' : $orderId
                    }
                    $.ajax({
                        type: 'get',
                        url: "/OrderStatusChange",
                        data: $data,
                        dataType: 'json',
                    });

                });

            });
        </script>

@endsection



