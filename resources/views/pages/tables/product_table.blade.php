@extends('pages.index',['title' => 'Products'])


@push('styles')
<!-- <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="{{asset('/css/globals/datatables.bundle.css')}}">
@endpush
@section('content')
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Products
                <!--begin::Separator-->
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <!--end::Separator-->
                <!--begin::Description-->
                <!-- <span class="text-muted fs-7 fw-bold mt-2">#XRS-45670</span> -->
                <!--end::Description-->
                <button type="button" id="addProd" class="btn btn-sm btn-secondary ms-2"><i class="fa-solid fa-plus"></i></button>
            </h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->


<div class="container">
    <!--begin::Card-->
    @if(session()->has('success'))
    <div class="alert alert-success text-center">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Product List
                <!-- <span class="text-muted pt-2 font-size-sm d-block"><i class="fa-solid fa-folder-plus"></i>Product List</span></h3> -->
            </div>
        </div>
        <div class="card-body">
            <table id="productList" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>Name</th>
                    <th>Unit Price</th>
                    <th>Lead Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach ($products['active_products'] as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->unit_price}}</td>
                        <td>{{$product->lead_time}}</td>
                        <td>
                        <a href="javascript:void(0)"  class="btn btn-info editInfo m-2 fa-solid fa-file-pen" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Product" data-product="{{$product->id}}">
                                <!-- <i class="fa-solid fa-file-pen"></i> -->
                            </a>
                            @if (Auth::user()->isAdmin())
                                <button href="" data-bs-toggle="tooltip modal" data-bs-placement="bottom" title="Delete Product" data-product="{{$product->id}}" class="btn btn-danger m-2 fa-solid fa-trash ms-2 deleteConfirm">
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
            <form method="post" action="{{route('products.store')}}">
                @csrf

                <div class="modal-body text-center">
                    <div class="card">
                        <div class="card-header justify-content-end ribbon ribbon-start ribbon-clip">
                            <div class="ribbon-label" style="font-size: 15px;">
                            Are you sure you want to delete this product?
                                <span class="ribbon-inner bg-danger"></span>
                            </div>
                            
                        </div>
                        <div class="card-body">
                        <input type="hidden" name="method" value="deleteProduct">
                        <input type="hidden" name="del_prod_id" id="del_prod_id">
                            <button type="submit" class="btn btn-primary btn-hover-rotate-end m-3">Yes</button>
                            <button type="button" class="btn btn-secondary btn-hover-rotate-end m-3" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                    <!-- <p class="fas fa-triangle-exclamation  text-danger" style="font-size: 50px;"></p><p style="font-size: 20px;">
                    Are you sure you want to delete this product?
                    </p>
                    <input type="hidden" name="method" value="deleteProduct">
                    <input type="hidden" name="del_prod_id" id="del_prod_id">
                    <button type="submit" class="btn btn-primary m-3">Yes</button>
                    <button type="button" class="btn btn-light m-3" data-bs-dismiss="modal">No</button> -->
                </div>
                
                    
                
                <!-- <div class="modal-footer">
                    
                </div> -->
            </form>
        </div>
    </div>
</div>

<!-- start :: addProduct modal -->
<div class="modal fade" tabindex="-1" id="addProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            <form method="post" action="{{route('products.store')}}" id="myForm" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="method" id="myMethod" value="addProduct">
                <input type="hidden" name="prod_id" id="prod_id" value="">
                <input type="hidden" name="status" value="1" id="status">
                <div class="text-center">
                    <p><h2>
                    <span id="modal-title">ADD PRODUCT
                    </h2></p>
                </div>

                <div class="mb-5">
                    <label class="required form-label">Category</label>
                    <select class="form-select form-select-solid" name="category_id" id="category_id" aria-label="Select Category">
                    @foreach ($products['active_categories'] as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Name</label>
                    <input type="text" class="form-control form-control-solid" name="name" id="name" placeholder="Name"/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Specifications</label>
                    <input type="text" class="form-control form-control-solid" name="specs" id="specs" placeholder="Specifications"/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Unit Price</label>
                    <input type="number" class="form-control form-control-solid" name="unit_price" id="unit_price" placeholder="Unit Price"/>
                </div>
                <div class="form-group row mb-5">
                    <div class="col-lg-6">
                        <label class="required form-label">Bundle Discount</label>
                        <input type="number" class="form-control form-control-solid" name="bundle_discount" id="bundle_discount" placeholder="Bundle Discount"/>
                    </div>
                    <div class="col-lg-6">
                        <label class="required form-label">Discount Percentage</label>
                        <input type="number" class="form-control form-control-solid" name="discount_percentage" id="discount_percentage" placeholder="Discount Percentage"/>
                    </div>
                </div>
                <div class="mb-5">
                        <label class="required form-label">Lead Time</label>
                        <input type="text" class="form-control form-control-solid" name="lead_time" id="lead_time" placeholder="Lead Time"/>
                    </div>
                </div>
                <div class="form-group row mb-5 text-center">
                    <div class="col-lg-12">
                        
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(/assets/media/avatars/300-1.jpg)"></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove button-->
                        </div>
                        <!--end::Image input-->
                        
                    </div>
                </div>
                <div class="form-group row mb-5 text-center">
                    <div class="col-lg-12">
                        <label class="form-label">Upload Image</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end :: addProduct modal -->

@endsection

@push('scripts')
<!-- <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" ></script> -->

<script src="{{asset('/js/globals/datatables.bundle.js')}}" ></script>
<script src="{{ mix('/js/pages/product/product.js')}}"></script>

</script>
@endpush
