@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Customer Message Lists </title>
@endsection

@section('content')

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        @if (session('deleteSuccess'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span> {{ session('deleteSuccess') }} </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif



                        <div class="col-lg-10 offset-1 table-responsive mb-5 mt-3">
                            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                                <thead class="thead-dark">
                                    <tr>

                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Date</th>
                                        <th></th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody class="align-middle " id="dataList" >
                                @foreach ($contact as $item)
                                    <tr>

                                        <td class="align-middle" >{{ $item->name}}</td>
                                        <td class="align-middle" >{{ $item->email}}</td>

                                        <td class="align-middle" >{{ $item->created_at->format('d-m-Y | H:i:s a')}}</td>
                                        <td class="align-middle " >
                                            <form action="{{route('Customer#MessageDetail',$item->id)}}" method="GET" >
                                                @csrf
                                                <button class="item  me-2 text-primary" type="submit" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="fa-solid fa-rectangle-list"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="align-middle " >
                                                <form action="{{route('Customer#MessageDelete',$item->id)}}" method="GET" >
                                                @csrf
                                                <button class="item  me-2 text-danger" type="submit" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <div class="mt-3">{{$contact->links()}}</div>
                            {{-- <div class="mt-2"> {{ $OrderList->links()}} </div> --}}
                        </div>




                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->

@endsection
















