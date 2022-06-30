<div>
    <style>
        label {
            font-size: 20px !important;
        }

        input::placeholder {
            text-align: right;
        }

        input {
            text-align: right;
        }
    </style>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">المُستخدمين</h5>
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
                    <span class="text-primary font-size-base font-weight-bolder"
                        id="kt_dashboard_daterangepicker_date">Aug
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
            <script>
                window.addEventListener('alert', event => {
                    toastr[event.detail.type](event.detail.message,
                        event.detail.title ?? ''), toastr.options = {
                        "closeButton": false,
                        "progressBar": true,
                        // "positionClass": "toast-top-center",
                    }
                });
            </script>
            <div class="card mb-3">
                <div class="card-header align-right text-right">
                    <div class="row">
                        <div class="col-sm-4 text-right">
                            <i class="fas fa-fw fa-users"></i>
                            قائمة المُستخدمين
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4 text-right">
                            {{-- <button type="button" class="btn btn-success btn-sm" style="float: left"
                                href="javascript:void(0);" data-toggle="modal" data-target="#createSeller"><i
                                    class="fas fa-fw fa-user-plus ml-3"></i>إضافة مدير</button> --}}
                        </div>
                    </div>
                    <!-- Create Selle\ -->

                    <div class="card-body">

                        <div class="table-responsive text-right">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>الايميل</th>
                                        <th>رقم الهاتف</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{!! $loop->iteration !!}</td>
                                            <td>{!! $user ? $user->name : '' !!}</td>
                                            <td>{!! $user ? $user->email : '' !!}</td>
                                            <td>{!! $user ? $user->phone : '' !!}</td>
                                            <td>
                                                <div class="row w-100 mx-auto">
                                                    <div class="col-xs-6 mr-2">
                                                            <button style="margin-bottom: 5px;" type="submit"
                                                                name="delete" value="{{ $user->id }}"
                                                                class="btn btn-danger btn-sm"
                                                               wire:click.prevent='showConfirm({{$user->id}})'><i
                                                                    class="fas fa-fw fa-user-minus"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Entry-->

    @push('scripts')
        <script>
                window.addEventListener('hide-modal', event =>  {
                    $('.modal').modal('hide');
                });
        </script>
    @endpush
</div>
