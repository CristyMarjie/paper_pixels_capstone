@extends('pages.index',['title' => 'Orders'])


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
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Orders</h1>
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
                <h3 class="card-label">Order List
                <!-- <span class="text-muted pt-2 font-size-sm d-block"><i class="fa-solid fa-folder-plus"></i>Product List</span></h3> -->
            </div>
        </div>
        <div class="card-body">
            <table id="productList" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>Order #</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach ($batch_orders as $batch_order)
                    <tr>
                        <td>00{{$batch_order->id}}</td>
                        <td>{{$batch_order->total_discount}}</td>
                        <td>{{$batch_order->total_amount}}</td>
                        <td>
                            @switch($batch_order->status)
                                @case(1)
                                    <span class="badge badge-light-dark">Order Placed</span>
                                    @break
                                @case(2)
                                    <span class="badge badge-light-primary">Production</span>
                                    @break
                                @case(3)
                                    <span class="badge badge-light-info">Shipped Out</span>
                                    @break
                                @case(4)
                                    <span class="badge badge-light-warning">Out for Delivery</span>
                                    @break
                                @case(5)
                                    <span class="badge badge-light-success">Delivered</span>
                                    @break
                                @default
                                    <p>Default case</p>
                            @endswitch
                        </td>
                        <td>
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                               
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            
                                <li><a class="dropdown-item orderProduction" data-batch="{{$batch_order->id}}">Order in Production</a></li>
                                <li><a class="dropdown-item shippedOut" data-batch="{{$batch_order->id}}">Shipped Out</a></li>
                                <li><a class="dropdown-item forDelivery" data-batch="{{$batch_order->id}}">Out for Delivery</a></li>
                                <li><a class="dropdown-item delivered" data-batch="{{$batch_order->id}}">Delivered</a></li>

                                @if (Auth::user()->isAdmin())
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                @endif
                            </ul>
                            </div>
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


@endsection

@push('scripts')
<script src="{{asset('/js/globals/datatables.bundle.js')}}" ></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{ mix('/js/pages/batch_order/batch_order.js')}}"></script>
@endpush
