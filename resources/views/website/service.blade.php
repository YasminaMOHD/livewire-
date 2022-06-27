<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('website/css/services.css') }}">
    @endpush
    <section class="u-clearfix u-custom-color-1 u-section-1" id="sec-20e5">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
                <div class="u-layout">
                    <div class="u-layout-row">
                        <div class="u-container-style u-layout-cell u-size-29 u-layout-cell-1">
                            <div class="u-container-layout u-container-layout-1">
                                <img class="u-image u-image-1"
                                    src="{{ asset('website/images/9870e9fae2550d863dba6cf15c7b49f4-removebg-preview.png') }}"
                                    data-image-width="500" data-image-height="500">
                            </div>
                        </div>
                        <div class="u-container-style u-layout-cell u-size-31 u-layout-cell-2">
                            <div class="u-container-layout u-container-layout-2">
                                <p class="u-align-right u-text u-text-default u-text-1">
                                    <span class="u-text-custom-color-9" style="font-size: 1.5rem;"> كيف يمكننا مساعدة
                                        <br>على نمو أعمالك؟ <br>
                                    </span>
                                    <span class="u-text-custom-color-6">نحن نسخر خبراتنا ومعرفتنا الصناعية لمساعدتك على
                                        النجاح</span>
                                </p>
                                <div class="u-align-center u-custom-color-1 u-form u-form-1">
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
                                    <form wire:submit.prevent="store"
                                        class="u-clearfix u-form-spacing-7 u-form-vertical u-inner-form" name="form"
                                        style="padding: 16px;">
                                        <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-1">
                                            <label for="text-3a3f"
                                                class="u-label u-text-custom-color-4 u-label-1">Input</label>
                                            <input type="email" placeholder="البريد الالكتروني" id="text-3a3f"
                                                name="email" wire:model.lazy="email"
                                                value="@if (Auth::check()) {{ Auth::user()->email }} @endif"
                                                class="u-border-2 u-border-custom-color-10 u-border-no-left @error('email') is-invalid @enderror u-border-no-right u-border-no-top u-input u-input-rectangle u-palette-5-light-3 u-radius-9 u-text-custom-color-4 u-input-1"
                                                required="required">
                                            @foreach ($errors->get('email') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="u-form-group u-form-name u-form-partition-factor-2 u-label-none">
                                            <label for="name-e56e"
                                                class="u-label u-text-custom-color-4 u-label-2">name</label>
                                            <input type="text" id="name-e56e" name="name"
                                                wire:model.lazy="name"
                                                @if (Auth::check()) {{ Auth::user()->name }} @endif
                                                class="u-border-2 u-border-custom-color-10 u-border-no-left @error('name') is-invalid @enderror u-border-no-right u-border-no-top u-input u-input-rectangle u-palette-5-light-3 u-radius-9 u-text-custom-color-4 u-input-2"
                                                placeholder="الاسم">
                                            @foreach ($errors->get('name') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>

                                        <div
                                            class="u-form-group u-form-partition-factor-2 u-form-select u-label-none u-form-group-3">
                                            <label for="select-19ab" class="u-label u-text-custom-color-4 u-label-3">نوع
                                                الخدمة </label>
                                            <div class="u-form-select-wrapper">
                                                <select id="select-19ab" name="category" wire:model.lazy="category"
                                                    class="u-border-2 u-border-custom-color-10 u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-palette-5-light-3 u-radius-9 u-text-custom-color-4 u-input-3"
                                                    autofocus="autofocus">
                                                    <option value="">نوع الخدمة</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"
                                                    version="1" class="u-caret">
                                                    <path fill="currentColor" d="M4 8L0 4h8z"></path>
                                                </svg>
                                            </div>
                                            @foreach ($errors->get('category') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>

                                        <div
                                            class="u-form-group u-form-partition-factor-2 u-form-phone u-label-none u-form-group-4">
                                            <label for="phone-ed04"
                                                class="u-label u-text-custom-color-4 u-label-4">Phone</label>
                                            <input type="tel"
                                                pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})"
                                                placeholder="الهاتف" wire:model.lazy="phone" id="phone-ed04"
                                                name="phone"
                                                @if (Auth::check()) {{ Auth::user()->phone }} @endif
                                                class="u-border-2 u-border-custom-color-10 @error('phone') is-invalid @enderror u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-palette-5-light-3 u-radius-9 u-text-custom-color-4 u-input-4">
                                            @foreach ($errors->get('phone') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-5">
                                            <label for="text-095b"
                                                class="u-label u-text-custom-color-4 u-label-5">Input</label>
                                            <input type="text" placeholder="مدة العمل" id="text-095b" name="timeWork"
                                                wire:model.lazy="duration"
                                                class="u-border-2 u-border-custom-color-10 u-border-no-left @error('duration') is-invalid @enderror u-border-no-right u-border-no-top u-input u-input-rectangle u-palette-5-light-3 u-radius-9 u-text-custom-color-4 u-input-5">
                                            @foreach ($errors->get('duration') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-6">
                                            <label for="text-e95a"
                                                class="u-label u-text-custom-color-4 u-label-6">Input</label>
                                            <input type="text" placeholder="اسم المشروع" id="text-e95a"
                                                name="nameProject" wire:model.lazy="project_name"
                                                class="u-border-2 u-border-custom-color-10 u-border-no-left @error('project_name') is-invalid @enderror u-border-no-right u-border-no-top u-input u-input-rectangle u-palette-5-light-3 u-radius-9 u-text-custom-color-4 u-input-6">
                                            @foreach ($errors->get('project_name') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="u-form-group u-form-message u-label-none u-form-group-7">
                                            <label for="message-05d7"
                                                class="u-label u-text-custom-color-4 u-label-7">Message</label>
                                            <textarea placeholder="معلومات إضافية" rows="4" cols="50" id="message-05d7" wire:model.lazy="otherInfo"
                                                name="message"
                                                class="u-border-2 u-border-custom-color-10 u-border-no-left u-border-no-right @error('otherInfo') is-invalid @enderror u-border-no-top u-input u-input-rectangle u-palette-5-light-3 u-radius-9 u-text-custom-color-4 u-input-7"
                                                maxlength="100" autofocus="autofocus"></textarea>
                                            @foreach ($errors->get('otherInfo') as $message)
                                                <span class="error">
                                                    {{ $message }}*
                                                </span>
                                            @endforeach
                                        </div>
                                        <div class="u-align-center u-form-group u-form-submit u-label-none">
                                            <button
                                                class="u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-17 u-btn-1">إرسال</button>
                                            <div wire:loading wire:target="store">
                                                ..... جاري الارسال
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
    </section>
</div>
