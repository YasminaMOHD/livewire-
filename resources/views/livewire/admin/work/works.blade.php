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

        video#myVideo {
            width: 120px !important;
            height: 80px !important;
        }
    </style>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الأعمال</h5>
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
                            قائمة الأعمال
                        </div>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm text-right row">
                            <div class="col-4">
                                <select name="filter-type" id="filter-type" wire:model.lazy="filterType"
                                    class="form-control bg-light" style="color: blue" wire:change="filter">
                                    <option value="all" selected>كل الأعمال</option>
                                    <option value="2">الأعمال المنشورة</option>
                                    <option value="3">الأعمال المرفوضة</option>
                                    <option value="1">أعمال تنتظر موافقة</option>
                                </select>
                                <div wire:loading wire:targer="filterType">
                                    جاري التحميل.....
                                </div>
                            </div>
                            <div class="col-4">
                                @if(Auth::user()->user_type == 'admin')
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
                            <div class="col-4">
                                <button type="button" class="btn btn-success btn-sm form-control" style="float: left"
                                    href="javascript:void(0);" data-toggle="modal" data-target="#createSeller"><i
                                        class="fas fa-fw fa-user-plus ml-3"></i>إضافة عمل جديد</button>
                            </div>
                        </div>
                    </div>
                    <!-- Create Selle\ -->
                    <!-- Large modal -->
                    <div class="modal fade bd-example-modal-lg text-right" id="createSeller" wire:ignore.self
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
                    </div>

                    <div class="card-body">
                        <div class="table-responsive text-right">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم العمل</th>
                                        <th>وصف العمل</th>
                                        <th>ملف العمل</th>
                                        <th>مُرفق العمل</th>
                                        <th>القسم</th>
                                        <th>حالة العمل</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($works as $work)
                                        <tr>
                                            <td>
                                                <div style="display :flex">
                                                    <input type="checkbox" style="margin-left: 7px"
                                                        name="selectWorks[]" wire:model.lazy="selectWorks"
                                                        value="{{ $work->id }}" @if($work->is_main == 1) checked @endif
                                                        wire:change.prevent="addToMainList({{ $work->id }})" id="check{{$work->id}}" />
                                                    {!! $loop->iteration !!}
                                                </div>
                                            </td>
                                            <td>{!! $work->title ?? '' !!}</td>
                                            <td>{!! $work->desc ?? '' !!}</td>
                                            <td>
                                                @php
                                                    $image_url = $work->file;
                                                    $ex = ['png', 'jpg', 'jpeg', 'svg', 'GIF', 'webp', 'PNG', 'JPG', 'JPEG', 'SVG', 'WEBP'];
                                                    $check = false;
                                                    foreach ($ex as $e) {
                                                        if (strpos($image_url, $e) == true) {
                                                            $check = true;
                                                        }
                                                    }
                                                @endphp
                                                @if ($check == true)
                                                    <img src="{{ Storage::url($work->file) }}" alt="work image"
                                                        style="width: 80px">
                                                @else
                                                    <video controls id="myVideo"
                                                        class="responsive-iframe nerds-iframe"
                                                        style="object-position: center">
                                                        <source src="{{ Storage::url($work->file) }}"
                                                            type="video/mp4">
                                                    </video>
                                                @endif
                                            </td>
                                            <td>{!! $work->user ? $work->user->name : '' !!}</td>
                                            <td>{!! $work->category ? $work->category->name : '' !!}</td>
                                            <td style="text-align: center">
                                                @if ($work->status == 0 || $work->status == 2)
                                                    <span class="text-success"> تم النشر</span>
                                                @endif
                                                @if ($work->status == 1)
                                                    <span class="text-warning"> بانتظار الموافقة </span>
                                                @endif
                                                @if ($work->status == 3)
                                                    <span class="text-danger mb-2"> مرفوضة <span>
                                                            <br>
                                                            {{-- {{$work->reject_reason}} --}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row ml-1 text-center" style="text-align: center">
                                                    <div class="col-xs-12 mr-2 mb-2 w-100 mx-auto">
                                                        <button id="edit"
                                                            wire:click.prevent='edit({{ $work->id }})'
                                                            class="btn btn-info btn-sm"><i
                                                                class="fas fa-fw fa-user-edit"></i></button>

                                                        <button type="submit" name="delete"
                                                            value="{{ $work->id }}" class="btn btn-danger btn-sm"
                                                            wire:click.prevent='showConfirm({{ $work->id }})'><i
                                                                class="fas fa-fw fa-user-minus"></i></button>
                                                    </div>
                                                    <div class="col-xs-12 mr-2 w-100 m-auto">
                                                        @if (($work->status == 1 || $work->status == 3) && (Auth::user()->user_type != 'employee'))
                                                            <button style="margin-bottom: 5px;" type="submit"
                                                                name="delete" value="{{ $work->id }}"
                                                                class="btn btn-success btn-sm"
                                                                wire:click.prevent='changeStatus({{ $work->id }},"approved")'>قبول</button>
                                                            <button style="margin-bottom: 5px;" type="submit"
                                                                name="delete" value="{{ $work->id }}"
                                                                class="btn btn-warning btn-sm"
                                                                wire:click.prevent='reasonReject({{ $work->id }})'>رفض</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Edit manger Modal -->
                            <div class="modal fade bd-example-modal-lg" id="editwork" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-label-">تعديل بيانات المدير</h5>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close">
                                                <span style="display: block" aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form wire:submit.prevent='update'>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <input type="text" id="title"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        name="title" placeholder="اسم العمل"
                                                        wire:model.lazy="title">
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
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}
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
                                                        <br>
                                                        <img src="{{ Storage::url($oldFile) }}" alt=""
                                                            style="width:80px;">
                                                        <input id="file" type="file"
                                                            class="form-control @error('file') is-invalid @enderror"
                                                            name="newFile" wire:model.lazy="newFile"
                                                            accept="video/*,image/*">
                                                        <div wire:loading wire:target="newFile">جاري التحميل ....</div>
                                                        @if ($newFile != '')
                                                            @php
                                                                $image_url = $newFile->temporaryUrl();
                                                                $ex = ['png', 'jpg', 'jpeg', 'svg', 'GIF', 'webp', 'PNG', 'JPG', 'JPEG', 'SVG', 'WEBP'];
                                                                $check = false;
                                                                foreach ($ex as $e) {
                                                                    if (strpos($image_url, $e) == true) {
                                                                        $check = true;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if ($check == true)
                                                                <img src="{{ $newFile->temporaryUrl() }}"
                                                                    alt="work image"
                                                                    style="width: 80px;  margin-top:20px">
                                                            @else
                                                                <video controls id="myVideo"
                                                                    class="responsive-iframe nerds-iframe"
                                                                    style="object-position: center;width:200px; height:100px; margin-top:20px">
                                                                    <source src="{{ $newFile->temporaryUrl() }}"
                                                                        type="video/mp4">
                                                                </video>
                                                            @endif
                                                        @endif
                                                        @foreach ($errors->get('newFile') as $message)
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
                                                    onclick="javascript:void(0)">تعديل العمل</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Edit manger Modal -->
                            <!-- reject reason  work  Modal -->
                            <div class="modal fade bd-example-modal-lg" id="rejectwork" tabindex="-1"
                                role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
                                wire:ignore.self>
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-label-">توضيح سبب رفض العمل</h5>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close">
                                                <span style="display: block" aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form wire:submit.prevent='goToReject'>
                                            <div class="modal-body">
                                                <div class="col-md-12">

                                                    <textarea class="form-control" id="reason" name="reason" style="margin-top: 15px;" wire:model.lazy="reason"
                                                        placeholder="سبب الرفض"></textarea>
                                                    @foreach ($errors->get('reason') as $message)
                                                        <span class="error">
                                                            {{ $message }}*
                                                        </span>
                                                    @endforeach

                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">إلغاء</button>
                                                        <button class="btn btn-success" type="submit" name="submit"
                                                            onclick="javascript:void(0)">إرسال</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- reject reason work Modal -->
                            {{ $works->links() }}
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
            window.addEventListener('show-reson-reject-work', event => {
                $('#rejectwork').modal('show');
            });
            window.addEventListener('show-worning-number-work', event => {
                Swal.fire("تجاوزت عدد الأعمال المسموح بها", "لقد اخترت بالفعل 6 عناصر لظهور في الصفحة الرئيسية !",
                    "warning");
            });
            window.addEventListener('remove_selected', event => {
                $("#check"+event.detail.id).prop("checked", false);
            });
        </script>
    @endpush
</div>
