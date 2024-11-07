@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Products </title>
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
                                    <h2 class="title-1">Product List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('Admin#ProductsCreatePage')}}">
                                    <button class="au-btn au-btn-icon btn-dark">
                                        <i class="zmdi zmdi-plus"></i>add Product
                                    </button>
                                </a>

                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="pt-2">  </h4>
                            </div>
                            <div class="mb-1">
                                <form class="form-header" action="{{ route('Admin#ProductsLists')}}" method="get">
                                    @csrf
                                    <input class="au-input au-input--xl form-control" type="text" name="key" value="{{ request('key')}}" placeholder="Search for datas &amp; reports..." />
                                    <button class="ms-1 col-1 btn-dark text-white " type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if (session('DeleteSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span> {{ session('DeleteSuccess') }} </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>

                        @endif

                    @if (count($Products) != 0)

                        <div class="col-lg-10 offset-1 table-responsive mb-5 mt-3">
                            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                             <div class="row">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="col-2 ">   Image           </th>
                                        <th class="col-2 ">   Name            </th>
                                        <th class="col-2 ">   Price           </th>
                                        <th class="col-2 ">   Category        </th>
                                        <th class="col-2 ">   View Count      </th>
                                        <th class="col-2 ">  </th>
                                    </tr>

                                </thead>

                             </div>
                                <tbody style="margin-top: 10px">


                               @foreach ($Products as $item )

                                <tr class="tr-shadow " >
                                    <td class="align-middle"> <img src="{{asset('storage/'.$item->image)}}" class="w-50" style="height: 75px"/>  </td>
                                    <td class="align-middle"> {{ $item->name }} </td>
                                    <td class="align-middle"> {{ $item->price }} </td>
                                    <td class="align-middle"> {{ $item->category_name }}</td>
                                    <td class="align-middle"> <i class="fa-solid fa-eye"></i> {{ $item->view_count }}  </td>
                                    <td class="align-middle">
                                        <div class="table-data-feature">
                                           <form action="{{ route('Admin#ProductDetail',$item->id)}}" method="GET" >
                                                <button class="item" type="submit" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                           </form>
                                           <form action="{{ route('Admin#ProductEditPage',$item->id)}}" method="GET" class="ms-2" >
                                            <button class="item" type="submit" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            </form>

                                            <form action="{{route('Admin#ProductDelete',$item->id)}}" class="ms-2" method="GET" >
                                                @csrf
                                                <button class="item" type="submit" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>


                               @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3 "> {{ $Products->appends(request()->query())->links() }}</div>
                        </div>
                        <!-- END DATA TABLE -->
                    @else
                        <h4 class="text-dark text-center mt-5"> not match any data ! </h4>
                    @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->

@endsection
