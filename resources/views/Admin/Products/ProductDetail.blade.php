@extends('Admin.Category.Layouts.CategoryMaster')

@section('content')


        <div class="main-content">
            <div class="section__content section__content--p30">
                <div><a href="{{route('Admin#ProductsLists')}}" class=" text-decoration-none text-dark fs-5 "><i class="fa-solid fa-arrow-left text-dark me-2" ></i>Back</a></div>
                <div class="col-lg-8 offset-2">
                    <div class="card mt-5" style="border-radius: 20px">
                        <div class="card-body" >
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Detail</h3>
                               <div class="row">
                                    <div class="col-4 offset-2 ">
                                        <div class="pt-5 mt-4">

                                        <img src="{{asset('storage/'.$Products->image)}}"  />

                                        </div>
                                    </div>
                                    <div class="col-5 offset-1">
                                       <div class="pt-5 mt-4">
                                            <span class="text-dark fw-bold  "> {{ $Products->name }} </span>
                                            <span class=" ms-2 text-muted" > (  {{$Products->category_name}}  )   </span>
                                            <p class="text-muted">  We pick the tastiest ingredients and create this sensational menu! Everything from pick sausages, Italian sausages, pepperoni, ham, bacon, onions, mushrooms and pineapple. That’s why we call it “Super Deluxe” </p>
                                            <span class="me-2 mt-2"> <i class="fa-solid fa-dollar-sign"></i> {{$Products->price}} MMK </span>
                                            <span class="me-2 mt-2"> <i class="fa-solid fa-clock"></i> {{$Products->waiting_time}} Minutes </span>
                                            <span class="mt-1"><i class="fa-regular fa-calendar-days"></i> {{$Products->created_at->format('d M Y')}} </span>
                                            <span class="mt-1"> <i class="fa-solid fa-eye"></i> {{$Products->view_count}} </span>
                                        </div>

                                        <div class="text-end mt-3">
                                            <a href="{{route('Admin#ProductEditPage',$Products->id)}}" class="btn bg-dark  text-white text-end">
                                                <i class="zmdi zmdi-edit"></i> Edit </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
