@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Category Lists </title>
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
                                <a href="{{ route('Category#createPage') }}">
                                    <button class="au-btn au-btn-icon btn-dark">
                                        <i class="zmdi zmdi-plus"></i>Add Category
                                    </button>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="pt-2"> Total = {{ count($categories)}} </h4>
                            </div>
                            <div class="mb-1">
                                <form class="form-header" action="{{ route('Category#lists') }}" method="get">
                                    @csrf
                                    <input class="au-input au-input--xl" type="text" name="key" value="{{ request('key')}}" placeholder="Search for datas &amp; reports..." />
                                    <button class="ms-1 col-1 btn-dark text-white" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if (session('DeleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span> {{ session('DeleteSuccess') }} </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>

                        @endif


                        <div class="col-lg-10 offset-1 table-responsive mb-5 mt-3">
                            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th> ID </th>
                                        <th>Categories Name</th>
                                        <th>date</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody style="margin-top: 10px">
                                    @foreach ($categories as $item)

                                        <tr class="tr-shadow " >
                                            <td class="align-middle"> {{ $item->id}} </td>
                                            <td class="align-middle"> {{ $item->name}} </td>
                                            <td class="align-middle"> {{ $item->created_at}} </td>
                                            <td class="align-middle">
                                                <div class="table-data-feature">
                                                   <form action="{{route('Category#EditPage',$item->id)}}" method="GET" >
                                                        <button class="item" type="submit" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                   </form>
                                                    <form action="{{ route('Category#Delete',$item->id) }}" method="GET" >
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
                        </div>
                        <!-- END DATA TABLE -->
                        <div> {{ $categories->appends(request()->query())->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
@endsection



