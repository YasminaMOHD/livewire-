<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
        <link rel="stylesheet" href="{{ asset('css/rate.css') }}">
        <style>
            .cart-item ul li {
                font-size: 13px !important;
                /* width: 18% */
            }
            /* li{
                width: 18%
            } */
        </style>
    @endpush
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
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container" style="text-align: right ;">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="cart-bar">
                        <div class="row">
                            <div class="col-lg-2">
                                <p>اسم المشروع</p>
                            </div>
                            <div class="col-lg row">
                                <div class="col-md-2 col-4"><span>مُدة التنفيذ</span></div>
                                <div class="col-md-2 col-4"><span>القسم</span></div>
                                <div class="col-md-2 col-4"><span>بيانات</span></div>
                                <div class="col-md-2 col-4"><span>الحالة</span></div>
                                <div class="col-md"><span>#</span></div>
                            </div>
                        </div>
                        <hr>
                    </div>
                   @foreach ($requests as $request)
                   <div class="cart-item row">
                    <div class="col-lg-2">
                                <p>{{$loop->iteration}} {{$request->project_name}}</p>
                                </p>
                    </div>
                    <div class="col-lg row">
                        <div class="col-md-2 col-4"><span>{{$request->duration}}</span></div>
                                <div class="col-md-2 col-4"><span>{{$request->category->name}}</span></div>
                                <div class="col-md-3 col-4"><span> {{$request->otherInfo}}</span></div>
                                <div class="col-md-2 col-4">
                                    @if($request->status == 4)
                                    <span class="text-warning">قيد التنفيذ</span>
                               @elseif($request->status == 5)
                                    <span class="text-success">مكتمل</span>
                               @else
                                   <span class="text-primary">تم الإرسال</span>
                               @endif
                                </div>
                                @if($request->status == 5)
                                <div class="col-md"> <button class="btn btn-warning" style="font-size: 11px !important" wire:click.prevent="showRate({{ $request->id }})"> ⭐ تقييم
                                    العمل</button></div>
                                @endif
                    </div>
                </div>
                <hr>
                   @endforeach
                    <div class="btn-cart text-right mt-4 mb-5">
                        <a class="btn btn-success" href="{{route('service')}}">طلب عمل جديد</a>
                    </div>
                      <div class="modal fade" wire:ignore.self id="rate" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="direction: ltr">
                            <button type="button" style="margin: 0 !important" class="close" data-dismiss="modal"
                                aria-label="Close">×</button>
                            <h5 class="modal-title" id="exampleModalLabel">ما هو تقييمك للعمل ؟</h5>
                        </div>
                        <div class="modal-body" style="direction: ltr">
                            <form wire:submit.prevent="rate"style="text-align:center">
                                <fieldset class="rate">
                                    <input type="radio" wire:model.lazy="store_rating" id="rating10"
                                        name="rating" value="10" />
                                    <label for="rating10" title="5 stars"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating9"
                                        name="rating" value="9" />
                                    <label class="half" for="rating9" title="4 1/2 stars"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating8"
                                        name="rating" value="8" />
                                    <label for="rating8" title="4 stars"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating7"
                                        name="rating" value="7" />
                                    <label class="half" for="rating7" title="3 1/2 stars"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating6"
                                        name="rating" value="6" />
                                    <label for="rating6" title="3 stars"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating5"
                                        name="rating" value="5" />
                                    <label class="half" for="rating5" title="2 1/2 stars"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating4"
                                        name="rating" value="4" />
                                    <label for="rating4" title="2 stars"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating3"
                                        name="rating" value="3" />
                                    <label class="half" for="rating3" title="1 1/2 stars"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating2"
                                        name="rating" value="2" />
                                    <label for="rating2" title="1 star"></label>
                                    <input type="radio" wire:model.lazy="store_rating" id="rating1"
                                        name="rating" value="1" />
                                    <label class="half" for="rating1" title="1/2 star"></label>
                                    <input type="radio" id="rating0" name="rating" value="0" />
                                    <label for="rating0" title="No star"></label>
                                </fieldset>
                        </div>
                        <div class="modal-footer" style="direction: rtl">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary">تقييم</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
      <script>
          window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.message,
                    event.detail.title ?? ''), toastr.options = {
                    "closeButton": false,
                    "progressBar": true,
                    // "positionClass": "toast-top-center",
                }
            });
          window.addEventListener('hide-modal', event => {
                $('.modal').modal('hide');
            });
            window.addEventListener('show-rate-model', event => {
                $("#rate").modal('show');
            });
      </script>
      @endpush
</div>
