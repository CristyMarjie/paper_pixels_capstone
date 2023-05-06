@extends('pages.index',['title' => 'Home'])


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
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Quote Requests
                <!--begin::Separator-->
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <!--end::Separator-->
                <!--begin::Description-->
                <!-- <span class="text-muted fs-7 fw-bold mt-2">#XRS-45670</span> -->
                <!--end::Description-->
               
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
                <h3 class="card-label">Quote Request List
                <!-- <span class="text-muted pt-2 font-size-sm d-block"><i class="fa-solid fa-folder-plus"></i>Product List</span></h3> -->
            </div>
        </div>
        <div class="card-body">
            <table id="productList" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>Request Title</th>
                    <th>Quantity</th>
                    <th>Dimension</th>
                    <th>Request Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach ($quote_requests as $quote_request)
                    <tr>
                        <td>{{$quote_request->quote_title}}</td>
                        <td>{{$quote_request->quantity}}</td>
                        <td>{{$quote_request->dimension}}</td>
                        <td>
                            @switch($quote_request->status)
                                @case(1)
                                    <span class="badge badge-light-warning">Pending Request</span>
                                    @break
                                @case(2)
                                    <span class="badge badge-light-success">Granted Request</span>
                                    @break
                                @default
                                    <p>Default case</p>
                            @endswitch
                        </td>
                        <td>
                            <a href="javascript:void(0)"  class="btn btn-info btnQuote m-2 fa-solid fa-circle-plus" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create Quotation" data-qrequest="{{$quote_request->id}}">
                                <!-- <i class="fa-solid fa-file-pen"></i> -->
                            </a>
                            @if (Auth::user()->isAdmin())
                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" class="btn btn-danger m-2 fa-solid fa-trash ms-2">
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

<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            

                <div class="modal-body">
                    <form method="post" action="{{route('quotations.store')}}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="method" value="createQuotation">
                        <input type="hidden" name="req_id" id="req_id">
                        <div class="mb-5">
                            <label class="required form-label">Quotation Title</label>
                            <input type="text" class="form-control form-control-solid" name="q_title" id="q_title" placeholder="Quotation Title"/>
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
                                        <input type="file" name="quote_file" accept=".pdf, .jpg, .jpeg" />
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
                        <div class="form-group row mb-5 text-center">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary btn-hover-rotate-end m-3">Submit</button>
                                <button type="button" class="btn btn-secondary btn-hover-rotate-end m-3" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-hover-rotate-end m-3">Submit</button>
                    <button type="button" class="btn btn-secondary btn-hover-rotate-end m-3" data-bs-dismiss="modal">Cancel</button>
                </div> -->

            
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{ mix('/js/pages/request_table/request_table.js')}}"></script>
@endpush
