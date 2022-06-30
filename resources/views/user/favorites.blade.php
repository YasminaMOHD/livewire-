<div>
    @push('styles')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/nicepage.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('website/css/work.css') }}">
@endpush
<!--begin::Subheader-->
<div class="u-body u-overlap u-overlap-transparent u-xl-mode">
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">المحفوظات</h5>
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
<section class="u-align-center u-clearfix u-section-1" style="" id="sec-3db2">
    <div class="u-tab-links-align-justify u-tabs u-tabs-1">
    </div>
    <div class="u-align-center u-gallery u-layout-grid u-lightbox u-show-text-on-hover u-gallery-1">
        <div class="u-gallery-inner u-gallery-inner-1">
            @foreach ($works as $work)
                <div class="work" style="position: relative;direction: ltr;">
                    <div class="favourite" wire:click.prevent="addFavorote({{$work->work->id}})">
                        @if(Auth::check())
                        @php
                            $favorote = App\Models\Favorite::where('user_id', Auth::user()->id)->where('work_id', $work->work->id)->first();
                        @endphp
                        @else
                            @php
                                $favorote = null;
                            @endphp
                        @endif
                        <i class="fas fa-heart" @if($favorote != null) style="color:red" @endif></i>
                    </div>
                    {{-- <div class="rate-section">
                        <button class="btn btn-warning" wire:click.prevent="showRate({{ $work->id }})"> ⭐ تقييم
                            العمل</button>
                    </div> --}}
                    <div class="u-effect-fade u-effect-hover-zoom u-gallery-item u-gallery-item-1">

                        <div class="u-back-slide u-back-slide-1">
                            <img class="u-back-image u-expanded" src="{{ Storage::url($work->work->file) }}"
                                alt="icon ">
                        </div>
                        <!-- hover () -->
                        <div class="u-over-slide u-shading u-over-slide-1 text-center">
                            <div class="u-gallery-heading">
                            </div>
                            <p class="u-gallery-text" style="margin-top: 0px;"></p>
                        </div>

                    </div>

                </div>
            @endforeach
            {{-- <div class="modal fade" wire:ignore.self id="rate" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" style="margin: 0 !important" class="close" data-dismiss="modal"
                                aria-label="Close">×</button>
                            <h5 class="modal-title" id="exampleModalLabel">ما هو تقييمك للعمل ؟</h5>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="rate">
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
            </div> --}}
        </div>
    </div>
    {{ $works->links() }}
</section>
</div>
@push('scripts')
<script class="u-script" type="text/javascript" src="{{asset('website/js/nicepage.js')}}" defer=""></script>
@endpush
</div>
