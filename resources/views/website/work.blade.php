<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('website/css/work.css') }}">
        <link rel="stylesheet" href="{{ asset('css/rate.css') }}">
    @endpush

    <section class="u-align-center u-clearfix u-section-1" style="margin-top: 160px !important" id="sec-3db2">
        <div class="u-tab-links-align-justify u-tabs u-tabs-1">
            <span  wire:loading wire:target="filter">
                <i  class="fas fa-spinner fa-spin"></i>
            </span>
            <ul class="u-spacing-0 u-tab-list u-unstyled" role="tablist"
                style="margin-bottom: 15px; border :1px solid #25a6d9 !important;border-radius:20px;
          box-shadow: 0px 3px 6px #00000029;">
                @php
                    $categories = \App\Models\Category::orderBy('id', 'desc')->get();
                @endphp
                @foreach ($categories as $category)
                    <li class="u-tab-item u-tab-item-2" role="presentation" wire:click.prevent="filter({{ $category->id }})">
                        <a class="u-active-grey-5 u-button-style u-hover-grey-5
                u-radius-50 u-tab-link u-text-active-custom-color-2 u-text-custom-color-6 u-white u-tab-link-2"
                             id="filter-{{ $category->id }}"
                             role="tab"
                            aria-controls="tab-4420" aria-selected="false"> {{ $category->name }}&nbsp;<br>
                        </a>
                    </li>
                @endforeach
                <li class="u-tab-item u-tab-item-1" role="presentation">
                    <a class="active u-active-grey-5 u-button-style u-hover-grey-5 u-radius-50 u-tab-link u-text-active-custom-color-2 u-text-custom-color-6 u-white u-tab-link-1"
                        id="filter-all" role="tab" aria-controls="tab-27ed" aria-selected="true"
                        wire:click.prevent="filter(-1)"> الكل</a>
                </li>
            </ul>

            {{-- <div class="u-tab-content">
                <div class="u-align-center u-container-style u-tab-active u-tab-pane u-tab-pane-1" id="tab-27ed"
                    role="tabpanel" aria-labelledby="link-tab-27ed">
                    <div class="u-container-layout u-container-layout-1"></div>
                </div>
                <div class="u-align-center u-container-style u-tab-pane u-tab-pane-2" id="tab-4420" role="tabpanel"
                    aria-labelledby="link-tab-4420">
                    <div class="u-container-layout u-container-layout-2"></div>
                </div>
                <div class="u-align-center u-container-style u-tab-pane u-tab-pane-3" id="tab-aa7b" role="tabpanel"
                    aria-labelledby="link-tab-aa7b">
                    <div class="u-container-layout u-container-layout-3"></div>
                </div>
                <div class="u-align-center u-container-style u-tab-pane u-tab-pane-4" id="tab-7262" role="tabpanel"
                    aria-labelledby="link-tab-7262">
                    <div class="u-container-layout u-container-layout-4"></div>
                </div>
                <div class="u-align-center u-container-style u-tab-pane u-tab-pane-5" id="tab-ab03" role="tabpanel"
                    aria-labelledby="link-tab-ab03">
                    <div class="u-container-layout u-container-layout-5"></div>
                </div>
                <div class="u-align-center u-container-style u-tab-pane u-tab-pane-6" id="tab-0da5" role="tabpanel"
                    aria-labelledby="link-tab-0da5">
                    <div class="u-container-layout u-container-layout-6"></div>
                </div>
                <div class="u-align-center u-container-style u-tab-pane u-tab-pane-7" id="tab-14b7" role="tabpanel"
                    aria-labelledby="link-tab-14b7">
                    <div class="u-container-layout u-container-layout-7"></div>
                </div>
                <div class="u-align-center u-container-style u-tab-pane u-tab-pane-8" id="tab-2917" role="tabpanel"
                    aria-labelledby="link-tab-2917">
                    <div class="u-container-layout u-container-layout-8"></div>
                </div>
            </div> --}}
        </div>
        <div style="padding-top: 40px"
            class="u-align-center u-gallery u-layout-grid u-lightbox u-show-text-on-hover u-gallery-1">
            <div class="u-gallery-inner u-gallery-inner-1">
                @foreach ($works as $work)
                    <div class="work" style="position: relative">
                        <div class="favourite" wire:click.prevent="addFavorote({{$work->id}})">
                            @if(Auth::check())
                            @php
                                $favorote = \App\Models\Favorite::where('user_id', Auth::user()->id)->where('work_id', $work->id)->first();
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
                                <img class="u-back-image u-expanded" src="{{ Storage::url($work->file) }}"
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
    @push('scripts')
        {{-- <script src="{{asset('js/js.js')}}"></script> --}}
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
            window.addEventListener('active', event => {
                $(".u-active-grey-5").removeClass('active');
                if(event.detail.checkAll == true){
                    $('#filter-'+event.detail.id).addClass('active');
                }else{
                    $('#filter-all').addClass('active');
            }
            });
            window.addEventListener('show-rate-model', event => {
                $("#rate").modal('show');
            });
        </script>
    @endpush
</div>
