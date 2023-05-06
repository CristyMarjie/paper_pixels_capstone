@extends('pages.index',['title' => 'Reviews'])


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
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Reviews
                <!--begin::Separator-->
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <!--end::Separator-->
                <!--begin::Description-->
                <!-- <span class="text-muted fs-7 fw-bold mt-2">#XRS-45670</span> -->
                <!--end::Description-->
                <a href="#" class="btn btn-sm btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#addProduct"><i class="fa-solid fa-plus"></i></a>
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
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Review List
                <!-- <span class="text-muted pt-2 font-size-sm d-block"><i class="fa-solid fa-folder-plus"></i>Product List</span></h3> -->
            </div>
        </div>
        <div class="card-body">
            <table id="productList" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>Customer</th>
                    <th>Order</th>
                    <th>Rate</th>
                    <th>Review</th>
                    <th>Actions</th> 
                 </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{$review->customer}}</td>
                        <td>{{$review->order}}</td>
                        <td>{{$review->rate}}</td>
                        <td>{{$review->review}}</td>

                        <td>
                        <a href="javascript:void(0)"  class="btn btn-info editInfo m-2 fa-solid fa-file-pen" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Review" data-product="{{$review->id}}">
                                <!-- <i class="fa-solid fa-file-pen"></i> -->
                            </a>
                            @if (Auth::user()->isAdmin())
                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Product" class="btn btn-danger m-2 fa-solid fa-trash ms-2">
                                    <!-- <i class="fa-solid fa-trash ms-2"></i> -->
                                </a>
                            @endif
                        </td>
                        
                        <!-- <td>
                            <a href="#"><i class="fa-solid fa-pen-to-square ms-2"></i></a>
                            @if (Auth::user()->isAdmin())
                                <a href="#"><i class="fa-solid fa-trash ms-2"></i></a>
                            @endif
                        </td> -->
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end::Datatable-->
        </div>
    </div>
    <!--end::Card-->
</div>

<!-- start :: addReview modal -->
<div class="modal fade" tabindex="-1" id="addProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            <form method="post" action="{{route('reviews.store')}}">
            @csrf
                <input type="hidden" name="method" value="addReview">
                <input type="hidden" name="status" value="1" id="status">
                <div class="text-center">
                    <p><h2>
                        ADD REVIEW
                    </h2></p>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Customer ID</label>
                    <input type="text" class="form-control form-control-solid" name="customer_id" id="customer_id" placeholder="Customer id"/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Order ID</label>
                    <input type="text" class="form-control form-control-solid" name="order_id" id="order_id" placeholder="Order id"/>
                </div>
               
                <div class="mb-5">
                    <label class="required form-label">Rate</label>
                    <input type="number" class="form-control form-control-solid" name="rate" id="rate" placeholder="Rate"/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Review</label>
                    <input type="text" class="form-control form-control-solid" name="review" id="review" placeholder="Review"/>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label">Reply</label>
                        <input type="text" class="form-control form-control-solid" name="reply" id="reply" placeholder="Reply"/>
                    </div>
               
                <div class="modal-footer">
                    <button type="button" id="submitReview" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end :: addReview modal -->

@endsection

@push('scripts')
<script src="{{asset('/js/globals/datatables.bundle.js')}}" ></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

@endpush
