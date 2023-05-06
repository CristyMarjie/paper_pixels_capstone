@extends('pages.index',['title' => 'Users'])


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
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Users
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
    @if(session()->has('success'))
    <div class="alert alert-success text-center">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Users List
                <!-- <span class="text-muted pt-2 font-size-sm d-block"><i class="fa-solid fa-folder-plus"></i>Product List</span></h3> -->
            </div>
        </div>
        <div class="card-body">
            <table id="productList" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->description}}</td>
                        <!-- <td>{{$user->active}}</td> -->
                        <td>
                            @if ($user->active == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>
                        <a href="javascript:void(0)"  class="btn btn-info editInfo m-2 fa-solid fa-file-pen" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit User" data-product="{{$user->id}}">
                                <!-- <i class="fa-solid fa-file-pen"></i> -->
                            </a>

                            @if (Auth::user()->isAdmin())
                                <button href="" data-bs-toggle="tooltip modal" data-bs-placement="bottom" title="Delete User" data-user="{{$user->id}}" class="btn btn-danger m-2 fa-solid fa-trash ms-2 deleteConfirm">
                                        <!-- <i class="fa-solid fa-trash ms-2"></i> -->
                                </button>
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
            <form method="post" action="{{route('users.store')}}">
                @csrf

                <div class="modal-body text-center">
                
                    <p class="fas fa-triangle-exclamation  text-danger" style="font-size: 50px;"></p><p style="font-size: 18px;">
                    Are you sure you want to delete this user?
                    </p>
                    <input type="hidden" name="method" value="deleteUser">
                    <input type="hidden" name="us_prod_id" id="us_prod_id">
                    <button type="submit" class="btn btn-primary m-3">Yes</button>
                    <button type="button" class="btn btn-light m-3" data-bs-dismiss="modal">No</button>
                </div>
                
                    
                
                <!-- <div class="modal-footer">
                    
                </div> -->
            </form>
        </div>
    </div>
</div>

<!-- start :: addUser modal -->
<div class="modal fade" tabindex="-1" id="addProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            <form method="post" action="{{route('users.store')}}">
            @csrf
                <input type="hidden" name="method" value="addUser">
                <input type="hidden" name="status" value="1" id="status">
                <div class="text-center">
                    <p><h2>
                        ADD USER
                </div>
                <div class="mb-5">
                    <label class="required form-label">First Name</label>
                    <input type="text" class="form-control form-control-solid" name="firstname" id="firstname" placeholder="" required/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Last Name</label>
                    <input type="text" class="form-control form-control-solid" name="lastname" id="lastname" placeholder="" required/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Phone Number</label>
                    <input type="text" class="form-control form-control-solid" name="phone_number" id="phone_number" placeholder="" required/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Address</label>
                    <input type="text" class="form-control form-control-solid" name="address1" id="address1" placeholder="" required/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Email</label>
                    <input type="email" class="form-control form-control-solid" name="email" id="email" placeholder="e.g. name@email.com" required/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Password</label>
                    <input type="text" class="form-control form-control-solid" name="password" id="password" placeholder="Password" required/>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Role</label>
                    <select class="form-select form-select-solid" name="role_id" id="role_id" aria-label="Select People">
                        <option value="1">Admin</option>
                        <option value="2">Staff</option>
                        <option value="3">Customer</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="submitUser" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end :: addUser modal -->

@endsection

@push('scripts')
<script src="{{asset('/js/globals/datatables.bundle.js')}}" ></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

@endpush
