
@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Admin Lists </title>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool  col-7 offset-5">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 fw-bold">Admin Lists</h2>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="pt-2 mb-3 d-inline">Total User = {{count($AdminDB)}}</h4>
                        </div>
                        <div class="mb-1">
                            <form class="form-header" action="{{ route('Admin#ListPage') }}" method="get">
                                @csrf
                                <input class="au-input au-input--xl" type="text" name="key" value="{{ request('key')}}" placeholder="Search for datas &amp; reports..." />
                                <button class="ms-1 col-1 btn-dark text-white" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @if (session('DeleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span> {{ session('DeleteSuccess') }} </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif

                    <div class="col-lg-10 offset-1 table-responsive mb-5 mt-3">
                        <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="col-1"> Image </th>
                                    <th class="col-2"> Name</th>
                                    <th class="col-2"> Email</th>
                                    <th class="col-2"> Address </th>
                                    <th class="col-2"> Phone Number </th>
                                    <th class="col-1"> Role </th>
                                    <th class="col-1"> </th>
                                </tr>
                            </thead>
                            <tbody class="align-middle "  >
                                @foreach ($AdminDB as $item)
                                @if ($item->role == 'Admin')
                                    <tr class="tr-shadow   ">
                                        <td class="align-middle">
                                            @if ($item->image == null)
                                                <img src="{{ asset('/Admin/images/default_image.jpg') }}"
                                                    class=" rounded-circle w-100" alt="..." />
                                            @else
                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                    class=" rounded-circle w-100" alt="..." />
                                            @endif
                                        </td>
                                        <input type="hidden" class="userID" value="{{$item->id}}" />
                                        <td class="align-middle"> {{$item->name}}</td>
                                        <td class="align-middle"> {{$item->email}}</td>
                                        <td class="align-middle"> {{$item->address}}</td>
                                        <td class="align-middle"> {{$item->phone_number}}</td>
                                        <td class="align-middle"> {{$item->role}}</td>
                                            @if ($item->id == Auth::user()->id)

                                            @else
                                            <td class="align-middle">
                                                <div class="table-data-feature">
                                                        <button class="item me-2 btnChange" type="submit"  data-toggle="tooltip" data-placement="top" title="Change Role"><i class="fa-solid fa-people-arrows"></i></button>
                                                        <form action="{{route('Admin#ListEditPage',$item->id)}}" method="GET" >
                                                            @csrf
                                                            <button class="item me-2" type="submit" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{route('Admin#Delete',$item->id)}}" method="GET" >
                                                            @csrf
                                                            <button class="item  me-2" type="submit" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                </div>
                                            </td>
                                            @endif
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{$AdminDB->links()}};
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('Script')
        <script>
            $(document).ready(function() {
                $('.btnChange').click(function(){
                    $parentNode = $(this).parents("tr");
                   $userId = $parentNode.find('.userID').val();


                   $.ajax({
                        type: 'get',
                        url: "/AdminRoleChange",
                        data: {
                            'userID': $userId,
                        },
                        dataType: 'json',
                        success:function(response) {
                            if(response.success) {
                                alert('Role changed successfully');
                                location.reload();
                            };
                         }
                    });

                })
            })
        </script>
@endsection
