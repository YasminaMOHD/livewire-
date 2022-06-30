<div>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
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

        video#myVideo {
            width: 120px !important;
            height: 80px !important;
        }

        .bootstrap-select.btn-group .btn .filter-option,
        .filter-option-inner-inner {
            text-align: right
        }
    </style>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">طلبات العمل</h5>
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
                            قائمة طلبات العمل
                        </div>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm text-right row">
                            <div class="col-4">
                                <input type="text" class="form-control" wire:model.lazy="search"
                                    placeholder="ادخل اسم المشروع للبحث عنه ...">
                            </div>
                            <div class="col-4">
                                <select name="filter-type" id="filter-type" wire:model.lazy="filterType"
                                    class="form-control bg-light" style="color: blue" wire:change="filter">
                                    <option value="all" selected>كل طلبات العمل</option>
                                    <option value="0">طلبات جديدة</option>
                                    <option value="1">طلبات مُعلقة</option>
                                    <option value="2">طلبات مقبولة</option>
                                    <option value="3">الطلبات المرفوضة</option>
                                    <option value="4">طلبات قيد التنفيذ</option>
                                    <option value="5">طلبات مكتملة</option>
                                </select>
                                <div wire:loading wire:targer="filterType">
                                    جاري التحميل.....
                                </div>
                            </div>
                            <div class="col-4">
                                @if (Auth::user()->user_type == 'admin')
                                    <select name="filter-cat" id="filter-cat" wire:model.lazy="filterCategory"
                                        class="form-control bg-light" style="color: blue" wire:change="filter">
                                        <option value="all" selected>كل التصنيفات</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:targer="filterCategory">
                                        جاري التحميل.....
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Create Selle\ -->
                    <!-- Large modal -->
                    {{-- <div class="modal fade bd-example-modal-lg text-right" id="createSeller" wire:ignore.self
                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100 text-right" id="exampleModalLabel">إضافة عمل جديد</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span style="display: block" aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form wire:submit.prevent='store'>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <input type="text" id="title"
                                                class="form-control @error('title') is-invalid @enderror" name="title"
                                                placeholder="اسم العمل" wire:model.lazy="title">
                                            @foreach ($errors->get('title') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach

                                            <textarea class="form-control" id="desc" name="desc" style="margin-top: 15px;" wire:model.lazy="desc"
                                                placeholder="وصف المشروع"></textarea>
                                            @foreach ($errors->get('desc') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                            <select style="margin-top: 15px;" wire:model.lazy="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                name="category">
                                                <option selected value="">اختر القسم</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @foreach ($errors->get('category') as $message)
                                                <span class="error">
                                                    {{ $message }}
                                                </span>
                                            @endforeach
                                            <div class="form-group" style="margin-top: 25px">
                                                <label for="file"
                                                    style="font-size: 15px !important; font-weight:normal;color:red">اختر
                                                    ملف العمل</label>
                                                <br><input id="file" type="file"
                                                    class="form-control @error('file') is-invalid @enderror"
                                                    name="file" wire:model.lazy="file"
                                                    accept="video/*,image/*">
                                                <div wire:loading wire:target="file">جاري التحميل ....</div>
                                                @if ($file != '')
                                                    @php
                                                        $image_url = $file->temporaryUrl();
                                                        $ex = ['png', 'jpg', 'jpeg', 'svg', 'GIF', 'webp', 'PNG', 'JPG', 'JPEG', 'SVG', 'WEBP'];
                                                        $check = false;
                                                        foreach ($ex as $e) {
                                                            if (strpos($image_url, $e) == true) {
                                                                $check = true;
                                                            }
                                                        }
                                                    @endphp
                                                    @if ($check == true)
                                                        <img src="{{ $file->temporaryUrl() }}" alt="work image"
                                                            style="width: 80px;  margin-top:20px">
                                                    @else
                                                        <video controls id="myVideo"
                                                            class="responsive-iframe nerds-iframe"
                                                            style="object-position: center;width:200px; height:100px; margin-top:20px">
                                                            <source src="{{ $file->temporaryUrl() }}"
                                                                type="video/mp4">
                                                        </video>
                                                    @endif
                                                @endif
                                                @foreach ($errors->get('file') as $message)
                                                    <span class="error">
                                                        {{ $message }}*
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button"
                                            data-dismiss="modal">إلغاء</button>
                                        <button class="btn btn-success" type="submit" name="submit"
                                            onclick="javascript:void(0)">إضافة عمل</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card-body">
                        <div class="table-responsive text-right">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم العميل</th>
                                        <th>هاتف العميل</th>
                                        <th>الايميل</th>
                                        <th>اسم المشروع</th>
                                        <th>تصنيف المشروع</th>
                                        <th>مدة العمل</th>
                                        <th>الموظف المسؤول</th>
                                        <th>معلومات أُخرى</th>
                                        <th>حالة الطلب</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>
                                                <div style="display :flex">
                                                    {!! $loop->iteration !!}
                                                </div>
                                            </td>
                                            <td>{!! $request->user ? $request->user->name : $request->guset->name !!}</td>
                                            <td>{!! $request->user ? $request->user->phone : $request->guset->phone !!}</td>
                                            <td>{!! $request->user ? $request->user->email : $request->guset->email !!}</td>
                                            <td>{!! $request->project_name ?? '' !!}</td>
                                            <td>{!! $request->category ? $request->category->name : '' !!}</td>
                                            <td>{!! $request->duration ?? '' !!}</td>
                                            @php
                                                $emp = App\Models\Employee::where('id', $request->employee_id)->first();
                                                if ($emp != null) {
                                                    $employee = App\Models\User::where('id', $emp->user_id)->first();
                                                } else {
                                                    $employee = null;
                                                }
                                            @endphp
                                            <td>{!! $employee ? $employee->name : '' !!}</td>
                                            <td>
                                                @if($request->otherInfo != null)
                                                <p class="show-more text-warning">اضغط للعرض</p>
                                                <p class="text-data" style="display:none">{!! $request->otherInfo ?? '' !!}</p>
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                @if ($request->status == 0)
                                                    <span class="text-primary">طلب جديد</span>
                                                @endif
                                                @if ($request->status == 1)
                                                    <span class="text-dark"> طلب مُعلق </span>
                                                @endif
                                                @if ($request->status == 2)
                                                    <span class="text-info"> طلب مقبول <span>
                                                @endif
                                                @if ($request->status == 3)
                                                    <span class="text-danger"> طلب مرفوض <span>
                                                @endif
                                                @if ($request->status == 4)
                                                    <span class="text-warning"> طلب قيد التنفيذ <span>
                                                @endif
                                                @if ($request->status == 5)
                                                    <span class="text-success">طلب مكتمل<span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="text-center" style="text-align: center;display:flex">
                                                    <button class="btn btn-success ml-2 btn-sm"
                                                        wire:click.prevent="update({{ $request->id }})"><i
                                                            class="fas fa-history"></i></button>
                                                    <button class="btn btn-warning btn-sm"
                                                        wire:click.prevent="goToAssign({{ $request->id }})">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                             <!-- Large modal -->
                             <div class="modal fade bd-example-modal-lg" id="history"
                                wire:ignore.self tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">الية سير العمل
                                            </h5>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close">
                                                <span style="display: block" aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="edit-2 mb-5">
                                                    @foreach ($descriptions as $desc)
                                                        <div class="p-2 mb-2 rounded bg-secondary">
                                                            <div class="edit-desc mb-3"
                                                                style="display: none">
                                                                <div>
                                                                    <textarea class="w-100 desc" name="desc" wire:model.lazy="newDescription">{!! $desc->text !!}</textarea>
                                                                    <button
                                                                        value="{!! $desc->id !!}"
                                                                        wire:click.prevent="updateDesc({{ $desc->id }})"
                                                                        class="updatedesc btn btn-hover btn-primary">تعديل
                                                                        الملاحظة</button>
                                                                    <div wire:loading
                                                                        wire.targer="updateDesc">
                                                                        <i
                                                                            class="fas fa-spinner fa-spin"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="p-1 mb-4 bg-light rounded textedit">
                                                                {!! $desc->text !!} </div>

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="by-class">
                                                                        @php
                                                                            $user = App\Models\User::find($desc->user_id);
                                                                        @endphp
                                                                        تم التعديل بواسطة :
                                                                        {!! $user ? $user->name : '' !!} </div>
                                                                    <div class="date-class">
                                                                        {!! $desc->created_at !!} </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="icons"
                                                                        style="display: flex;  flex-direction: row-reverse;">
                                                                        <button class="editbtndesc ml-1"
                                                                            id="edit-{!! $desc->id !!}"
                                                                            style="border-radius: 50%"
                                                                            wire:click.prevent="editDesc({{ $desc->id }})"><i
                                                                                class="fas fa-pencil-alt prefix"></i></button>
                                                                        {{-- <form action=""> --}}
                                                                        <button class="deldesc ml-1"
                                                                            style="border-radius: 50%"
                                                                            value="{!! $desc->id !!}"
                                                                            wire:click.prevent="getToDeleteDescription({{ $desc->id }})"><i
                                                                                class="fas fa-fw fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!--Textarea with icon prefix-->
                                                <form id="form-desc" wire:submit.prevent="edit">
                                                    <div class="md-form amber-textarea active-amber-textarea"
                                                        style="margin-bottom: 25px;">
                                                        <i class="fas fa-pencil-alt prefix"
                                                            style="position: absolute; float: right; right: 10px !important;"></i>
                                                        <textarea name="oldDescription" id="" class="md-textarea form-control" rows="3"
                                                            wire:model.lazy="oldDescription" placeholder="اكتب وصف عن العمل ...."></textarea>
                                                        <!-- <label for="form-desc-">Write description here ...</label> -->
                                                    </div>

                                                    <div class="status-request" wire:ignore>
                                                        <input type="radio" class="ml-1"
                                                            name="lead_status" value="0"
                                                            wire:model.lazy="status" required>
                                                        <label class="text-primary"
                                                            style="font-size: 14px !important;margin-left:13px">طلب
                                                            جديد</label>
                                                        <input type="radio" class="ml-1"
                                                            name="lead_status" value="1"
                                                            wire:model.lazy="status" required>
                                                        <label class="text-dark"
                                                            style="font-size: 14px !important;margin-left:13px">طلب
                                                            مُعلق</label>
                                                        <input type="radio" class="ml-1"
                                                            name="lead_status" value="3"
                                                            wire:model.lazy="status" required>
                                                        <label class="text-danger"
                                                            style="font-size: 14px !important;margin-left:13px">طلب
                                                            مرفوض</label>
                                                        <input type="radio" class="ml-1"
                                                            name="lead_status" id="approved_status"
                                                            value="2" wire:model.lazy="status"
                                                            required>
                                                        <label class="text-success"
                                                            style="font-size: 14px !important;margin-left:13px">طلب
                                                            مقبول</label>

                                                        <input type="radio" class="ml-1"
                                                            id="underway" name="lead_status"
                                                            value="4" wire:model.lazy="status"
                                                            required>
                                                        <label class="text-warning"
                                                            style="font-size: 14px !important;margin-left:13px">طلب
                                                            قيد
                                                            التنفيذ</label>
                                                        <input type="radio" class="ml-1"
                                                            name="lead_status" value="5"
                                                            wire:model.lazy="status" required>
                                                        <label class="text-success"
                                                            style="font-size: 14px !important;margin-left:13px">طلب
                                                            مكتمل</label>
                                                    </div>


                                                    <div class="modal-footer" wire:ignore>
                                                        <div id="delivery-time"
                                                            class="delivery-time ml-auto"
                                                            style="display: none">
                                                            <div id="delveriryDay">حدد يوم التسليم : <input
                                                                    type="date"
                                                                    wire:model.lazy="delivryTime"
                                                                    name="deleviry">
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">إلغاء</button>
                                                        <input class="btn btn-success" type="submit"
                                                            name="add_desc" value="تأكيد">

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <style>
                                            .icons button {
                                                height: 30px;
                                                font-size: 14px;

                                                text-align: center;
                                                color: #fff;
                                                border: none;
                                                width: 30px;
                                            }

                                            .deldesc {
                                                background-color: red;
                                                color: #fff
                                            }

                                            .editbtndesc {
                                                background: cadetblue;
                                                color: #fff
                                            }

                                            .select_reminder {
                                                background: #00c853;
                                                color: #fff;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                            {{-- request assign --}}
                            <div class="modal fade bd-example-modal-lg" id="showHistory" wire:ignore.self
                                tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-label">تحديد موظف للعمل</h5>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close">
                                                <span style="display: block" aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form wire:submit.prevent="assign">
                                            <div class="modal-body">
                                                <div class="col-md-12" wire:ignore>
                                                    <label for="selectpicker3">اختر موظف</label>
                                                    <select name="employee" class="selectpicker w-100"
                                                        id="selectpicker3" required data-live-search="true"
                                                        style="text-align: right" wire:model.lazy="employee">
                                                        <option value="" selected>اختر موظف</option>
                                                        @php
                                                            if (Auth::user()->user_type == 'admin') {
                                                                $employees = App\Models\Employee::with('user')->get();
                                                            } else {
                                                                $manger = App\Models\Manger::where('user_id', Auth::user()->id)->first();
                                                                $employees = App\Models\Employee::with('user')
                                                                    ->where('category_id', $manger->category_id)
                                                                    ->get();
                                                            }
                                                        @endphp

                                                        @foreach ($employees as $employee)
                                                            <option value="{!! $employee ? $employee->id : '' !!}">
                                                                {!! $employee->user ? $employee->user->name : '' !!}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">إلغاء</button>
                                                <button class="btn btn-success" type="submit" name="update"
                                                    id="update-{!! $employee ? $employee->id : '' !!}"
                                                    value="{!! $employee ? $employee->id : '' !!}">تحديد</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if(count($requests))
                            {{ $requests->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Entry-->

    @push('scripts')
        <script src="{{ asset('js/bootstrap-select.js') }}"></script>
        <script>
            $('.selectpicker').selectpicker();
            window.addEventListener('hide-modal', event => {
                $('.modal').modal('hide');
            });
            window.addEventListener('showHistory', event => {
                $('#showHistory').modal('show');
            });
            window.addEventListener('controlWork', event => {
                $('#history').modal('show');
            });
            window.addEventListener('editDescription', event => {
                $('#edit-'+ event.detail.id).parent().parent().parent().parent().find('.rounded').fadeToggle();
                $('#edit-'+ event.detail.id).parent().parent().parent().parent().find('.edit-desc').fadeToggle();
            });
            $(document).on('change', '#selectpicker3', function(e) {
                //when ever the value of changes this will update your PHP variable
                @this.set('employee', e.target.value);
            });
            // $(document).on('click', '#approved_status', function() {
            //     $(this).parent().parent().find('.approved').fadeToggle();
            // });
            $(document).on('click', '#underway', function() {
                $(this).parent().parent().find('.modal-footer #delivery-time').fadeToggle();
            });
            $(document).on('click','.show-more',function(){
                $(this).parent().find('.text-data').fadeToggle();
            })
        </script>
    @endpush
</div>
