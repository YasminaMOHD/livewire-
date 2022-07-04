@extends('Admin.layouts.master')
@section('content')
    <style>
        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card>hr {
            margin-right: 0;
            margin-left: 0;
        }


        .card-body-icon {
            position: absolute;
            z-index: 0;
            top: 0;
            right: 0;
            opacity: 0.4;
            font-size: 5rem !important;
            -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
        }

        .card-title {
            margin-bottom: 0.75rem;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-footer:last-child {
            border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
        }

        .card-header-tabs {
            margin-right: -0.625rem;
            margin-bottom: -0.75rem;
            margin-left: -0.625rem;
            border-bottom: 0;
        }

        .card-body-icon i {
            font-size: 5rem;
        }
    </style>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">لوحة التحكم</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">

                <!--begin::Daterange-->
                <a href="#" class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_dashboard_daterangepicker"
                    data-toggle="tooltip" title="Select dashboard daterange" data-placement="left">
                    <span class="text-muted font-size-base font-weight-bold mr-2"
                        id="kt_dashboard_daterangepicker_title">Today</span>
                    <span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_daterangepicker_date">Aug
                        16</span>
                </a>
                <!--end::Daterange-->

            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-2 col-4 mb-3">
                    <div class="card text-white o-hidden h-100" style="background-color: #6c757d">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            @php
                                if (Auth::user()->user_type == 'admin') {
                                    $count = App\Models\Request::where('status', 0)->count();
                                } else if (Auth::user()->user_type == 'employee') {
                                    $emp = App\Models\Employee::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 0)
                                        ->where('employee_id', $emp->id)
                                        ->count();
                                } else {
                                    $manger = App\Models\Manger::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 0)
                                        ->where('category_id', $manger->category_id)
                                        ->count();
                                }
                            @endphp
                            <div style="text-align: left;font-size: 18px"> {{ $count }} طلبات جديدة</div>
                        </div>
                        {{-- <a class="card-footer text-white clearfix small z-1" wire:model.lazy="filterCategory"
                            href="{{ route('admin.request') }}">
                            {{-- <span class="float-left">عرض القائمة</span> --}}
                            {{-- <span class="float-right">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        </a>  --}}
                    </div>
                </div>
                <div class="col-md-2 col-4 mb-3">
                    <div class="card text-white o-hidden h-100" style="background-color: #17a2b8">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="far fa-snowflake"></i>
                            </div>
                            @php
                                if (Auth::user()->user_type == 'admin') {
                                    $count = App\Models\Request::where('status', 1)->count();
                                } else if (Auth::user()->user_type == 'employee') {
                                    $emp = App\Models\Employee::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 1)
                                        ->where('employee_id', $emp->id)
                                        ->count();
                                } else {
                                    $manger = App\Models\Manger::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 1)
                                        ->where('category_id', $manger->category_id)
                                        ->count();
                                }
                            @endphp
                            <div style="text-align: left;font-size: 18px">{{ $count }} طلبات مُعلقة</div>
                        </div>
                        {{-- <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">عرض القائمة</span>
                            <span class="float-right">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        </a> --}}
                    </div>
                </div>
                <div class="col-md-2 col-4 mb-3">
                    <div class="card text-white o-hidden h-100" style="background-color: #f462d4">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-people-arrows"></i>
                            </div>
                            @php
                                if (Auth::user()->user_type == 'admin') {
                                    $count = App\Models\Request::where('status', 2)->count();
                                }else if (Auth::user()->user_type == 'employee') {
                                    $emp = App\Models\Employee::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 2)
                                        ->where('employee_id', $emp->id)
                                        ->count();
                                } else {
                                    $manger = App\Models\Manger::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 2)
                                        ->where('category_id', $manger->category_id)
                                        ->count();
                                }
                            @endphp
                            <div style="text-align: left;font-size: 18px"> {{ $count }} الطلبات المقبولة</div>
                        </div>
                        {{-- <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">عرض القائمة</span>
                            <span class="float-right">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        </a> --}}
                    </div>
                </div>
                <div class="col-md-2 col-4 mb-5">
                    <div class="card text-white o-hidden h-100" style="background-color: #dc3545">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-times"></i>
                            </div>
                            @php
                                if (Auth::user()->user_type == 'admin') {
                                    $count = App\Models\Request::where('status', 3)->count();
                                } else if (Auth::user()->user_type == 'employee') {
                                    $emp = App\Models\Employee::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 3)
                                        ->where('employee_id', $emp->id)
                                        ->count();
                                } else {
                                    $manger = App\Models\Manger::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 3)
                                        ->where('category_id', $manger->category_id)
                                        ->count();
                                }
                            @endphp
                            <div style="text-align: left;font-size: 18px"> {{ $count }} الطلبات المرفوضة</div>
                        </div>
                        {{-- <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">عرض القائمة</span>
                            <span class="float-right">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        </a> --}}
                    </div>
                </div>
                <div class="col-md-2 col-4 mb-5">
                    <div class="card text-white o-hidden h-100" style="background-color: #ffc107">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                            @php
                                if (Auth::user()->user_type == 'admin') {
                                    $count = App\Models\Request::where('status', 4)->count();
                                } else if (Auth::user()->user_type == 'employee') {
                                    $emp = App\Models\Employee::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 4)
                                        ->where('employee_id', $emp->id)
                                        ->count();
                                } else {
                                    $manger = App\Models\Manger::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 4)
                                        ->where('category_id', $manger->category_id)
                                        ->count();
                            } @endphp
                            <div style="text-align: left;font-size: 18px"> {{ $count }} طلبات قيد التنفيذ</div>
                        </div>
                        {{-- <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">عرض القائمة</span>
                            <span class="float-right">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        </a> --}}
                    </div>
                </div>
                <div class="col-md-2 col-4 mb-5">
                    <div class="card text-white o-hidden h-100" style="background-color: #28a745">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            @php
                                if (Auth::user()->user_type == 'admin') {
                                    $count = App\Models\Request::where('status', 5)->count();
                                } else if (Auth::user()->user_type == 'employee') {
                                    $emp = App\Models\Employee::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 5)
                                        ->where('employee_id', $emp->id)
                                        ->count();
                                } else {
                                    $manger = App\Models\Manger::where('user_id', Auth::user()->id)->first();
                                    $count = App\Models\Request::where('status', 5)
                                        ->where('category_id', $manger->category_id)
                                        ->count();
                            } @endphp
                            <div style="text-align: left;font-size: 18px">{{ $count }} الطلبات المكتملة</div>
                        </div>
                        {{-- <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">عرض القائمة</span>
                            <span class="float-right">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        </a> --}}
                    </div>
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
