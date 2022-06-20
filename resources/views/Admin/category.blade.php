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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">التصنيفات</h5>
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
                            قائمة التصنيفات
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4 text-right" >
                            <button type="button" class="btn btn-success btn-sm" style="float: left" href="#" data-toggle="modal"
                                data-target="#createSeller"><i class="fas fa-fw fa-user-plus"></i>إضافة تصنيف</button>
                        </div>
                    </div>
                <!-- Create Selle\ -->

                <!-- Large modal -->

                <div class="modal fade bd-example-modal-lg text-right" id="createSeller" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title w-100 text-right" id="exampleModalLabel">إضافة تصنيف جديد</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span style="display: block" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{route('admin.category.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <input style="margin-bottom: 15px;" type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="اسم التصنيف" required>
                                            @foreach ($errors->get('name') as $message)
                                            <span class="error">
                                                {{ $message }}*
                                            </span>
                                           @endforeach
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                                    <input class="btn btn-success" type="submit" name="submit" value="إضافة تصنيف" />
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
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($categories as $category)
                                <tr>
                                    <td>{!! $loop->iteration !!}</td>
                                    <td>{!! $category->name !!}</td>
                                    <td>
                                        <div class="row ml-1">
                                            <div class="col-xs-6 mr-2">
                                                <form action='{{route('admin.category.destroy',$category)}}' method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button style="margin-bottom: 5px;" type="submit" name="delete" value="{{$category->id}}"
                                                        class="btn btn-danger btn-sm" onsubmit="validate(e)"><i
                                                            class="fas fa-fw fa-user-minus"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-xs-6 mr-3">
                                                <button id="edit" data-role="edit" data-toggle="modal"
                                                    data-target="#editSeller-{!!$category->id!!}" value="{!! $category->id !!}" class="btn btn-info btn-sm"><i
                                                        class="fas fa-fw fa-user-edit"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Edit Seller Modal -->

                                    <div class="modal fade bd-example-modal-lg" id="editSeller-{!!$category->id!!}" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edit-label-">تعديل بيانات التصنيف</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form id="form-edit-{!!$category->id!!}" action="{{route('admin.category.update',$category)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" id="{!!$category->id!!}" />
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <input style="margin-bottom: 15px;" type="text" id="name-{!!$category->id!!}"
                                                                class="form-control" name="name"
                                                                placeholder="اسم التصنيف" value="{!!$category->name!!}" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">إلغاء</button>
                                                        <button class="btn btn-success" type="submit" name="update"
                                                            id="update-{!!$category->id!!}">تعديل</button>
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
