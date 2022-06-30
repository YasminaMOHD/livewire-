<div>
    <style>
        label {
            font-size: 14px !important;
        }

        input::placeholder {
            text-align: right;
        }

        input {
            text-align: right;
        }

        video#myVideo {
            width: 120px !important;
            height: 80px !important;
        }

        .show-more {
            cursor: pointer;
        }
    </style>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">تحديد الصلاحيات</h5>
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
                            صلاحيات المستخدين
                        </div>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm text-right row">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-success btn-sm form-control" style="float: left"
                                    href="javascript:void(0);" data-toggle="modal" data-target="#createrole"><i
                                        class="fas fa-fw fa-user-plus ml-3"></i>إضافة صلاحيات</button>
                            </div>
                        </div>
                    </div>
                    <!-- Create Selle\ -->
                    <!-- Large modal -->
                    <div class="modal fade bd-example-modal-lg" id="createrole" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">انشاء صلاحيات للمستخدين</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span style="display: block" aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form wire:submit.prevent="store">
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <select name="name" id="name" wire:ignore
                                             wire:model.lazy="name"
                                                class="form-control">
                                                <option value=""class="p-2">اختر المستخدم</option>
                                                <option value="manger"class="p-2">المدير</option>
                                                <option value="employee" class="p-2" selected>الموظف</option>
                                            </select> <br>
                                            @foreach ($errors->get('name') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                            <p>اختر صلاحيات المستخدام :</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input icheck-primary checkjs"
                                                            type="checkbox" id="select-all" wire:change.prevent='selectAll'>
                                                        <label class="form-check-label">
                                                            الكل
                                                        </label>
                                                    </div>
                                                </div>
                                                @foreach (config('permission') as $key=>$v)
                                                    <div class="col-md-4 col-sm-6 col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input icheck-primary"
                                                                wire:model.lazy="permissions"  type="checkbox"
                                                                value="{{$key}}" name="permission[]">
                                                            <label class="form-check-label">
                                                                {{ $v }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div> <br>
                                            @foreach ($errors->get('permissions') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button"
                                            data-dismiss="modal">الغاء</button>
                                        <input class="btn btn-success" type="submit" name="submit" value="تأكيد" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{!! $loop->iteration !!}</td>
                                            <td>{!! $role->name !!}</td>
                                            <td style="display: flex">
                                                <button style="margin-bottom: 5px;margin-left:15px"
                                                    wire:click.prevent="showConfirm({{ $role->id }})" name="delete"
                                                    value="1" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-fw fa-user-minus"></i></button>

                                                <button style="margin-bottom: 5px; margin-left:5px"
                                                    wire:click.model="update({{ $role->id }})"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-fw fa-user-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- End Edit lead Modal -->
                                    <!-- Edit role Modal -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Edit role Modal -->

                        <div class="modal fade bd-example-modal-lg" wire:ignore.self id="editwork" tabindex="-1"
                            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-label-">تعديل الصلاحيات</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span style="display: block" aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form wire:submit.prevent="edit">
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <select name="name" wire:ignore class="form-control" wire:model.lazy="name"
                                                    id="name">
                                                    <option value="" selected class="p-2">
                                                        اختر المستخدم </option>
                                                    <option value="manger" class="p-2">
                                                        المدير </option>
                                                    <option value="employee" class="p-2">
                                                        الموظف </option>
                                                </select> <br>
                                                @foreach ($errors->get('name') as $message)
                                                    <span class="error">
                                                        {{ $message }}*
                                                    </span>
                                                @endforeach

                                                <p>اختر صلاحيات المستخدم :</p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input icheck-primary  checkjs"
                                                                type="checkbox" id="select-all2" wire:change.prevent="selectAll">
                                                            <label class="form-check-label">
                                                                الكل
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @foreach (config('permission') as $key=>$v)
                                                        <div class="col-md-4 col-sm-6 col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input icheck-primary"
                                                                    type="checkbox" value="{{ $key }}"
                                                                    wire:model.lazy="permissions" name="permission[]" >
                                                                <label class="form-check-label">
                                                                    {{ $v }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                 <br>
                                                @foreach ($errors->get('permissions') as $message)
                                                    <span class="error">
                                                        {{ $message }}*
                                                    </span>
                                                @endforeach
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">الغاء</button>
                                                <button class="btn btn-success" type="submit" name="update"
                                                    id="update-1" value="1">تأكيد</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Entry-->

    @push('scripts')
        <script>
            window.addEventListener('hide-modal', event => {
                $('.modal').modal('hide');
            });
            window.addEventListener('show-edit-work', event => {
                $('#editwork').modal('show');
            });
            window.addEventListener('checkAll', event => {
                        $('input[type="checkbox"]').each(function() {
                             this.checked = event.detail.checkAll;
                         })

                     });
        </script>
    @endpush
</div>
