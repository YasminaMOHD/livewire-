@extends('Admin.layouts.master')
@section('content')
    <style>
        label {
            font-size: 20px !important;
        }
        input::placeholder{
            text-align: right;
        }
        input{
            text-align: right;
        }
    </style>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">المُدراء</h5>
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
        <div class="container" style="text-align: right ;">
            <div class="card mb-3">
                <div class="card-header align-right text-right">
                    <div class="row">
                        <div class="col-sm-4 text-right">
                            <i class="fas fa-fw fa-users"></i>
                            قائمة المُدراء
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4 text-right" >
                            <button type="button" class="btn btn-success btn-sm" style="float: left" href="#" data-toggle="modal"
                                data-target="#createSeller"><i class="fas fa-fw fa-user-plus"></i>إضافة مدير</button>
                        </div>
                    </div>
                <!-- Create Selle\ -->

                <!-- Large modal -->

                <div class="modal fade bd-example-modal-lg text-right" id="createSeller" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title w-100 text-right" id="exampleModalLabel">إضافة مدير جديد</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span style="display: block" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{route('admin.manger.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <input style="margin-bottom: 15px;" type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="اسم المدير" required>
                                            @foreach ($errors->get('name') as $message)
                                            <span class="error">
                                                {{ $message }}*
                                            </span>
                                           @endforeach

                                        <input style="margin-bottom: 15px;" type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="الايميل" required>
                                            @foreach ($errors->get('email') as $message)
                                                <span class="error">
                                                    {{ $message }}
                                                </span>
                                            @endforeach

                                        <input style="margin-bottom: 15px;" type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Password" required>
                                            @foreach ($errors->get('password') as $message)
                                            <span class="error">
                                                {{ $message }}*
                                            </span>
                                            @endforeach

                                        <input style="margin-bottom: 15px;" type="tel" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" pattern="+[0-9]{12}" placeholder="رقم الهتف" required>
                                            @foreach ($errors->get('phone') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                                    <input class="btn btn-success" type="submit" name="submit" value="إضافة مدير" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <div class="table-responsive text-right">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الايميل</th>
                                    <th>رقم الهاتف</th>
                                    <th>القسم</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($mangers as $manger)
                                <tr>
                                    <td>{!! $loop->iteration !!}</td>
                                    <td>{!! $manger->user->name !!}</td>
                                    <td>{!! $manger->user->email !!}</td>
                                    <td>{!! $manger->user->phone !!}</td>
                                    <td>{!! $manger->category->name !!}</td>
                                    <td>
                                        <div class="row ml-1">
                                            <div class="col-xs-6 mr-2">
                                                <form action='{{route('admin.manger.destroy',$manger)}}' method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button style="margin-bottom: 5px;" type="submit" name="delete" value="{{$manger->id}}"
                                                        class="btn btn-danger btn-sm" id="kt_sweetalert_demo_8">><i
                                                            class="fas fa-fw fa-user-minus"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-xs-6">
                                                <button id="edit" data-role="edit" data-toggle="modal"
                                                    data-target="#editSeller-{!!$manger->id!!}" value="{!! $manger->id !!}" class="btn btn-info btn-sm"><i
                                                        class="fas fa-fw fa-user-edit"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Edit Seller Modal -->

                                    <div class="modal fade bd-example-modal-lg" id="editSeller-{!!$manger->id!!}" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edit-label-">تعديل بيانات المدير</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form id="form-edit-{!!$manger->id!!}" action="{{route('admin.manger.update',$manger)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" id="{!!$manger->id!!}" />
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <input style="margin-bottom: 15px;" type="text" id="name-{!!$manger->id!!}"
                                                                class="form-control" name="name"
                                                                placeholder="اسم المدير" value="{!!$manger->user ? $mager->user->name : '' !!}" required>
                                                            <input style="margin-bottom: 15px;" type="email" id="email-{!!$manger->id!!}"
                                                                class="form-control" name="email"
                                                                placeholder="الايميل" value="{!!$manger->user ? $manger->user->email : ''!!}"
                                                                required>
                                                            <input style="margin-bottom: 15px;" type="password"
                                                                id="password-{!!$manger->id!!}" class="form-control" name="password"
                                                                placeholder="New Password" required>
                                                            <input style="margin-bottom: 15px;" type="tel" id="phone-{!!$manger->id!!}"
                                                                class="form-control" name="phone" pattern="+[0-9]{12}"
                                                                placeholder="رقم الهاتف" value="{!!$manger->user ? $manger->user->phone : '' !!}" required>
                                                            <select name="category" id="category-{!!$manger->id!!}" class="form-control">
                                                                @foreach ($categories as $category )
                                                                <option value="{!!$category->id!!}" @if($manger->category->id == $category->id) selected @endif>{!!$category->name!!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">إلغاء</button>
                                                        <button class="btn btn-success" type="submit" name="update"
                                                            id="update-{!!$manger->id!!}">تعديل</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Edit Seller Modal -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Entry-->
@stop

