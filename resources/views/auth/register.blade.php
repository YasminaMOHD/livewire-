<style>
    .btn{
        color: white;
        padding: 8px 0;
        text-align: center;
        border-radius: 10px;
        max-width: 100%
    }
    .btn-facebook{
        background-color: #0078ff;
        width: 100%;
    }
    .btn-google{
        background: #ff3e30;
        width: 100%;
        text-align: center
    }
    .hover-me:hover{
    background-image: linear-gradient(
        to right,
        rgba(0,0,0, 0.05),
        rgba(0,0,0, 0.05)
    );
}
.social-btn{
    width: 47%
}
</style>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('phone') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
        <p class="my-2">OR Register Use :</p>
        <div class="row" style="display:flex; text-align: center">
            <div class="col-md-6 flex items-center justify-center mt-4 mr-3 social-btn">
                <a href="{{route('facebook')}}" class="btn btn-facebook hover-me">
                    <span style="font-weight: bolder">facebook</span></a>
            </div>
            <div class="col-md-6 flex items-center justify-center mt-4 social-btn">
                <a href="{{route('google')}}" class="btn btn-google hover-me">
                    <span style="font-weight: bolder"> Google+ </span></a>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
