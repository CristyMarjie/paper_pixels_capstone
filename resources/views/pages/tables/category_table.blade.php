@extends('pages.index',['title' => 'Categories'])


@push('styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Categories
                <!--begin::Separator-->
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <!--end::Separator-->
                <!--begin::Description-->
                <!-- <span class="text-muted fs-7 fw-bold mt-2">#XRS-45670</span> -->
                <!--end::Description-->
                <button type="button" id="addCat" class="btn btn-sm btn-secondary ms-2"><i class="fa-solid fa-plus"></i></button>
            </h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
<div class="container">

    @if(session()->has('success'))
    <div class="alert alert-success text-center">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif

    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Category List
                <!-- <span class="text-muted pt-2 font-size-sm d-block"><i class="fa-solid fa-folder-plus"></i>Product List</span></h3> -->
            </div>
        </div>
        <div class="card-body">
            <table id="productList" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td>
                            <!-- <a href="javascript:;" class="btn btn-outline-secondary p-3 px-4 m-2 editInfo" data-category="{{$category->id}}">Buy Now</a> -->
                            <!-- <a href="javascript:void(0)" class="editInfo" data-category="{{$category->id}}"><i class="fa-solid fa-file-pen text-info"></i></a> -->
                            <a href="javascript:void(0)"  class="btn btn-info editInfo m-2 fa-solid fa-file-pen" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Category" data-category="{{$category->id}}">
                                <!-- <i class="fa-solid fa-file-pen"></i> -->
                            </a>

                            @if (Auth::user()->isAdmin())
                                <button href="" data-bs-toggle="tooltip modal" data-bs-placement="bottom" title="Delete Category" data-category="{{$category->id}}" class="btn btn-danger m-2 fa-solid fa-trash ms-2 deleteConfirm">
                                        <!-- <i class="fa-solid fa-trash ms-2"></i> -->
                                </button>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end::Datatable-->
        </div>
    </div>
    <!--end::Card-->
</div>

<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{route('categories.store')}}">
                @csrf

                <div class="modal-body text-center">

                    <div class="card">
                        <div class="card-header justify-content-end ribbon ribbon-start ribbon-clip">
                            <div class="ribbon-label" style="font-size: 15px;">
                            Are you sure you want to delete this category?
                                <span class="ribbon-inner bg-danger"></span>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="method" value="deleteCategory">
                            <input type="hidden" name="cat_prod_id" id="cat_prod_id">
                            <button type="submit" class="btn btn-primary btn-hover-rotate-end m-3">Yes</button>
                            <button type="button" class="btn btn-secondary btn-hover-rotate-end m-3" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                    
                    <!-- <p class="fas fa-triangle-exclamation  text-danger" style="font-size: 50px;"></p><p style="font-size: 18px;">
                    Are you sure you want to delete this category?
                    </p>
                    <input type="hidden" name="method" value="deleteCategory">
                    <input type="hidden" name="cat_prod_id" id="cat_prod_id">
                    <button type="submit" class="btn btn-primary m-3">Yes</button>
                    <button type="button" class="btn btn-light m-3" data-bs-dismiss="modal">No</button> -->
                </div>
                
                <!-- <div class="modal-footer">
                    
                </div> -->
            </form>
        </div>
    </div>
</div>

<!-- start :: addCategory modal -->
<div class="modal fade" tabindex="-1" id="addCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            <form method="post" action="{{route('categories.store')}}" id="myForm">
                @csrf
                <input type="hidden" name="method" id="myMethod" value="addCategory">
                <input type="hidden" name="cat_id" id="cat_id" value="">
                <input type="hidden" name="status" value="1" id="status">

                <div class="text-center">
                    <p><h2><span id="modal-title">ADD CATEGORY</span>
                    </h2></p>
                </div>

                <div class="mb-5">
                    <label class="required form-label">Name</label>
                    <input type="text" class="form-control form-control-solid" name="name" id="name" placeholder="Category Name" required/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Description</label>
                    <input type="text" class="form-control form-control-solid" name="cat_description" id="cat_description" placeholder="Description" required/>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submitCategory" class="btn btn-light" data-bs-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- end :: addCatergory modal -->


@endsection

@push('scripts')
<!-- <script src="{{asset('/js/globals/datatables.bundle.js')}}" ></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script> -->

<script src="{{ mix('/js/pages/category/category.js')}}"></script>
@endpush
