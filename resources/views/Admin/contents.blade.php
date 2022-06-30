<div>
    <style>
        label {
            font-size: 20px !important;
        }
    </style>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">محتوى الموقع</h5>
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
        <div class="container" style="text-align: right">
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
            <form wire:submit.prevent="update">
                <div class="form-group">
                    <label for="whatOffer">ماذا نُقدم ؟</label>
                    <div wire:ignore>
                        <textarea class="summernote  @error('whatOffer') is-invalid @enderror" id="kt_summernote_1" name="whatOffer"
                            wire:model="whatOffer"></textarea>
                    </div>
                    @error('whatOffer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="OurMessage">رسالتنا</label>
                    <div wire:ignore>
                        <textarea class="summernote @error('OurMessage') is-invalid @enderror" id="kt_summernote_2" name="OurMessage"
                            wire:model="OurMessage"></textarea>
                    </div>
                    @error('OurMessage')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="whoWe">من نحن ؟</label>
                    <div wire:ignore>
                        <textarea class="summernote @error('whoWe') is-invalid @enderror" id="kt_summernote_3" name="whoWe"
                            wire:model="whoWe"></textarea>
                    </div>
                    @error('whoWe')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mechanismWork">آلية العمل</label>
                    <div wire:ignore>
                        <textarea class="summernote @error('mechanismWork') is-invalid @enderror" id="kt_summernote_4" name="mechanismWork"
                            wire:model="mechanismWork"></textarea>
                    </div>
                    @error('mechanismWork')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group text-center align-center">
                    <button class="btn btn-primary w-50 text-center" style="font-size: 17px;font-weight: bold">تعديل
                        المحتوى</button>
                </div>
            </form>
        </div>
    </div>
    <!--end::Entry-->
    @push('scripts')
        <script>
            jQuery(document).ready(function() {
                $('#kt_summernote_1').summernote({
                    codemirror: {
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('whatOffer', contents, $editable);
                        }
                    }
                });
                $('#kt_summernote_2').summernote({
                    codemirror: {
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('OurMessage', contents, $editable);
                        }
                    }
                });
                $('#kt_summernote_3').summernote({
                    codemirror: {
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('whoWe', contents, $editable);
                        }
                    }
                });
                $('#kt_summernote_4').summernote({
                    codemirror: {
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('mechanismWork', contents, $editable);
                        }
                    }
                });
            });
        </script>
    @endpush
</div>
