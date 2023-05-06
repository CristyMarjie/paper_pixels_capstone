@extends('pages.index',['title' => 'Quotation'])


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
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Quotation
                <!--begin::Separator-->
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <!--end::Separator-->
                <!--begin::Description-->
                <!-- <span class="text-muted fs-7 fw-bold mt-2">#XRS-45670</span> -->
                <!--end::Description-->
                @if (Auth::user()->isAdmin())
                    <a href="#" class="btn btn-sm btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#addreq_table"><i class="fa-solid fa-plus"></i></a>
                @endif
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
                <h3 class="card-label">Quotation List
                <!-- <span class="text-muted pt-2 font-size-sm d-block"><i class="fa-solid fa-folder-plus"></i>Product List</span></h3> -->
            </div>
        </div>
        <div class="card-body">
            <table id="productList" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>Quotation #</th>
                    <th>Quotation Title</th>
                   <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach ($quotations as $quotation)
                    <tr>
                        <td>{{$quotation->id}}</td>
                        <td>{{$quotation->quotation_tile}}</td>
                        <td>
                        <a href="/assets/quotations/{{$quotation->id}}.pdf"  class="btn btn-info m-2 fa-solid fa-download" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download File" download>
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
<!-- start :: addQuotation modal -->
<div class="modal fade" tabindex="-1" id="addreq_table">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            <form method="post" action="{{route('quotations.store')}}">
            @csrf
                <input type="hidden" name="method" value="addQuotation">
                <input type="hidden" name="status" value="1" id="status">
                <div class="text-center">
                    <p><h2>
                        ADD QUOTATION 
                    </h2></p>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Quote Request</label>
                    <input type="text" class="form-control form-control-solid" name="quote_request_id" id="quote_request_id" placeholder="Customer"/>
                </div>
               
                <div class="mb-5">
                    <label class="required form-label">Quotation Title</label>
                    <input type="text" class="form-control form-control-solid" name="quotation_tile" id="quotation_tile" placeholder="Quotation Title"/>
                </div>
                <div class="form-group">
                    <!--begin::Dropzone-->
                    <div class="dropzone dropzone-queue mb-2" id="kt_modal_upload_dropzone">
                        <!--begin::Controls-->
                        <div class="dropzone-panel mb-4">
                            <a class="dropzone-select btn btn-sm btn-primary me-2 dz-clickable">Attach files</a>
                            <a class="dropzone-upload btn btn-sm btn-light-primary me-2">Upload All</a>
                            <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
                        </div>
                        <!--end::Controls-->
                        <!--begin::Items-->
                        <div class="dropzone-items wm-200px">
                            
                        </div>
                        <!--end::Items-->
                    <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files here to upload</button></div></div>
                    <!--end::Dropzone-->
                    <!--begin::Hint-->
                    <span class="form-text fs-6 text-muted">Max file size is 1MB per file.</span>
                    <!--end::Hint-->
                </div>
                </div>
                    <div class="modal-footer">
                    <button type="button" id="submitQuotation" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end :: addQuotation modal -->
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
@endpush
