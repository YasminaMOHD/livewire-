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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الموظفين</h5>
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
                            قائمة الموظفين
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="button" class="btn btn-success btn-sm" style="float: left"
                                href="javascript:void(0);" data-toggle="modal" data-target="#createSeller"><i
                                    class="fas fa-fw fa-user-plus ml-3"></i>إضافة موظف</button>
                        </div>
                    </div>
                    <!-- Create Selle\ -->

                    <!-- Large modal -->

                    <div class="modal fade bd-example-modal-lg text-right" id="createSeller" wire:ignore.self
                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100 text-right" id="exampleModalLabel">إضافة موظف جديد</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span style="display: block" aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form wire:submit.prevent='store'>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                placeholder="اسم الموظف" wire:model.lazy="name">
                                            @foreach ($errors->get('name') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach

                                            <input style="margin-top: 15px;" type="tel" id="phone"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                pattern="+[0-9]{12}" placeholder="رقم الهاتف" wire:model.lazy="phone"
                                                required>
                                            @foreach ($errors->get('phone') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                            <select style="margin-top: 15px;" wire:model.lazy="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                name="category">
                                                <option selected>اختر القسم</option>
                                                @if (Auth::user()->user_type == 'manger')
                                                    @php
                                                        $manger = App\Models\Manger::with('category')
                                                            ->where('user_id', Auth::user()->id)
                                                            ->first();
                                                    @endphp
                                                    <option value="{{ $manger->category->id }}">
                                                        {{ $manger->category->name }}</option>
                                                @else
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @foreach ($errors->get('category') as $message)
                                                <span class="error">
                                                    {{ $message }}
                                                </span>
                                            @endforeach
                                            <input style="margin-top: 15px;" type="email" wire:model.lazy="email"
                                                id="email1" class="form-control @error('email') is-invalid @enderror"
                                                name="email" placeholder="الايميل" required>
                                            @foreach ($errors->get('email') as $message)
                                                <span class="error">
                                                    {{ $message }}
                                                </span>
                                            @endforeach
                                            <input style="margin-top: 15px;" type="password" wire:model.lazy='password'
                                                id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Password" required>
                                            @foreach ($errors->get('password') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button"
                                            data-dismiss="modal">إلغاء</button>
                                        <button class="btn btn-success" type="submit" name="submit"
                                            onclick="javascript:void(0)">إضافة موظف</button>
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

                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{!! $loop->iteration !!}</td>
                                            <td>{!! $employee->user ? $employee->user->name : '' !!}</td>
                                            <td>{!! $employee->user ? $employee->user->email : '' !!}</td>
                                            <td>{!! $employee->user ? $employee->user->phone : '' !!}</td>
                                            <td>{!! $employee->category ? $employee->category->name : '' !!}</td>
                                            <td>
                                                <div class="row w-100 mx-auto">
                                                    <div class="col-xs-6 mr-3">
                                                        <button id="edit"
                                                            wire:click.prevent='edit({{ $employee->id }})'
                                                            class="btn btn-info btn-sm"><i
                                                                class="fas fa-fw fa-user-edit"></i></button>
                                                    </div>
                                                    <div class="col-xs-6 mr-2">
                                                        <button style="margin-bottom: 5px;" type="submit"
                                                            name="delete" value="{{ $employee->id }}"
                                                            class="btn btn-danger btn-sm"
                                                            wire:click.prevent='showConfirm({{ $employee->id }})'><i
                                                                class="fas fa-fw fa-user-minus"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Edit employee Modal -->
                            <div class="modal fade bd-example-modal-lg" id="editemployee" tabindex="-1"
                                role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
                                wire:ignore.self>
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-label-">تعديل بيانات الموظف</h5>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close">
                                                <span style="display: block" aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form wire:submit.prevent="update">
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" placeholder="اسم الموظف"
                                                        wire:model.lazy="name">
                                                    @foreach ($errors->get('name') as $message)
                                                        <span class="error">
                                                            {{ $message }}
                                                        </span>
                                                    @endforeach
                                                    <input style="margin-top: 15px;" type="tel"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        name="phone" pattern="+[0-9]{12}" placeholder="رقم الهاتف"
                                                        wire:model.lazy="phone">
                                                    @foreach ($errors->get('phone') as $message)
                                                        <span class="error">
                                                            {{ $message }}
                                                        </span>
                                                    @endforeach
                                                    <select name="category"
                                                        class="form-control mt-4 @error('category') is-invalid @enderror"
                                                        wire:model.lazy="category">
                                                        <option selected disabled>اختر القسم</option>
                                                        @if (Auth::user()->user_type == 'manger')
                                                            @php
                                                                $manger = App\Models\Manger::with('category')
                                                                    ->where('user_id', Auth::user()->id)
                                                                    ->first();
                                                            @endphp
                                                            <option value="{{ $manger->category->id }}">
                                                                {{ $manger->category->name }}</option>
                                                        @else
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @foreach ($errors->get('category') as $message)
                                                        <span class="error">
                                                            {{ $message }}
                                                        </span>
                                                    @endforeach
                                                    <input style="margin-top: 15px;" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" placeholder="الايميل"
                                                        wire:model.lazy="email">
                                                    @foreach ($errors->get('email') as $message)
                                                        <span class="error">
                                                            {{ $message }}
                                                        </span>
                                                    @endforeach
                                                    <input style="margin-top: 15px;" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" placeholder="كلمة السر"
                                                        wire:model.lazy="password">
                                                    @foreach ($errors->get('password') as $message)
                                                        <span class="error">
                                                            {{ $message }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">إلغاء</button>
                                                <button class="btn btn-success" type="submit" name="update"
                                                    onclick="javascript:void(0)">تعديل</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Edit employee Modal -->
                            {{ $employees->links() }}
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
            window.addEventListener('show-edit-employee', event => {
                $('#editemployee').modal('show');
            });
        </script>
    @endpush
</div>
