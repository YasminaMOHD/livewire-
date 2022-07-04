<div>
    <!--begin::Notifications-->
    <div class="dropdown ml-5">
        <style>
            .unread{
                background-color: #f5f5f5;
            }
        </style>
        <!--begin::Toggle-->
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                <span class="svg-icon svg-icon-xl svg-icon-primary">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                        </g>
                    </svg><span class="notify-count">{{$unread}}</span>
                    <!--end::Svg Icon-->
                </span>
                <span class="pulse-ring"></span>
            </div>
        </div>
        <!--end::Toggle-->
        <!--begin::Dropdown-->
        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg"
        style="overflow-y: scroll !important">
            <form>

                <!--begin::Content-->
                <div class="tab-content" >
                    <!--begin::Tabpane-->
                    <div class="tab-pane active show p-8" id="topbar_notifications_notifications"
                        role="tabpanel">
                        <!--begin::Scroll-->
                        <div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300"
                            data-mobile-height="200">
                            <!--begin::Item-->
                            @foreach ($notifications as $notify)
                            <div class="d-flex align-items-center mb-6 p-3 @if($notify->unread()) unread @endif">
                                <!--begin::Text-->
                                <div class="d-flex flex-column font-weight-bold">
                                    <a href="{{route('one-notify', $notify->id)}}"
                                        class="text-dark text-hover-primary mb-1 font-size-lg">{{$notify->data['title']}}</a>
                                    <span class="text-muted">{{$notify->created_at->locale('ar')->diffForHumans()}}</span>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                            @endforeach
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Action-->
                        {{-- <div class="d-flex flex-center pt-7">
                            <a href="#" class="btn btn-light-primary font-weight-bold text-center">كل الاشعارات</a>
                        </div> --}}
                        <!--end::Action-->
                    </div>
                    <!--end::Tabpane-->

                    <!--begin::Tabpane-->
                    <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                        <!--begin::Nav-->
                        <div class="d-flex flex-center text-center text-muted min-h-200px">All caught up!
                            <br />No new notifications.
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Tabpane-->
                </div>
                <!--end::Content-->
            </form>
        </div>
        <!--end::Dropdown-->
    </div>
    <!--end::Notifications-->
</div>
