@extends('Admin.layouts.master')
@section('content')
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
        <div class="container" style="text-align: right">
            <form>
                @csrf
                <div class="form-group">
                    <label for="whatOffer">ماذا نُقدم ؟</label>
                    <input class="summernote  @error('whatOffer') is-invalid @enderror" id="kt_summernote_1" name="whatOffer"
                        id="whatOffer" wire:model.lazy="whatOffer"></textarea>
                    @error('whatOffer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="OurMessage">رسالتنا</label>
                    <textarea class="summernote @error('OurMessage') is-invalid @enderror" id="kt_summernote_2" name="OurMessage"
                        id="OurMessage" wire:model="OurMessage"></textarea>
                    @error('OurMessage')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="whoWe @error('whoWe') is-invalid @enderror">من نحن ؟</label>
                    <textarea class="summernote" id="kt_summernote_3" name="whoWe" id="whoWe" wire:model="whoWe"></textarea>
                    @error('whoWe')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mechanismWork">آلية العمل</label>
                    <textarea class="summernote @error('mechanismWork') is-invalid @enderror" id="kt_summernote_4" name="mechanismWork"
                        id="mechanismWork" wire:model="mechanismWork"></textarea>
                    @error('mechanismWork')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group text-center align-center">
                    <button class="btn btn-primary w-50 text-center" wire:click.prevent="update()" style="font-size: 17px;font-weight: bold">تعديل
                        المحتوى</button>
                </div>
            </form>
        </div>
    </div>
    <!--end::Entry-->
@stop


@section('script')
    <script src="{{ asset('assets/js/pages/crud/forms/editors/summernote.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@stop
