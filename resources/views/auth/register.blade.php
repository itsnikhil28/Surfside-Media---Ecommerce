@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="login-register container">
        <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab"
                    href="#tab-item-register" role="tab" aria-controls="tab-item-register"
                    aria-selected="true">Register</a>
            </li>
        </ul>
        <div class="tab-content pt-2" id="login_register_tab_content">
            <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel"
                aria-labelledby="register-tab">
                <div class="register-form">
                    <form method="POST" action="{{ route('register') }}" name="register-form" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control form-control_gray " name="name" value="{{old('name')}}" required=""
                                autocomplete="name" autofocus="">
                            <label for="name">Name</label>
                        </div>
                        <div class="pb-3"></div>
                        <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control form-control_gray " name="email" value="{{old('email')}}"
                                required="" autocomplete="email">
                            <label for="email">Email address *</label>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input id="phoneno" type="text" class="form-control form-control_gray " name="phoneno"
                                value="{{old('phoneno')}}" required="" autocomplete="mobile">
                            <label for="phoneno">Mobile *</label>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control form-control_gray " name="password"
                                required="" autocomplete="new-password">
                            <label for="password">Password *</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password_confirmation" type="password" class="form-control form-control_gray"
                                name="password_confirmation" required="" autocomplete="password_confirmation">
                            <label for="password_confirmation">Confirm Password *</label>
                        </div>

                        <div class="d-flex align-items-center mb-3 pb-2">
                            <p class="m-0">Your personal data will be used to support your experience throughout this
                                website, to
                                manage access to your account, and for other purposes described in our privacy policy.
                            </p>
                        </div>

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>

                        <div class="customer-option mt-4 text-center">
                            <span class="text-secondary">Have an account?</span>
                            <a href="/login" class="btn-text js-show-register">Login to your Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
{{-- <form method="POST">
    @csrf

    <div>
        <x-label for="name" value="{{ __('Name') }}" />
        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
            autocomplete="name" />
    </div>

    <div class="mt-4">
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autocomplete="username" />
    </div>

    <div class="mt-4">
        <x-label for="phoneno" value="{{ __('Phone Number') }}" />
        <x-input id="phoneno" class="block mt-1 w-full" type="number" inputmode="numeric" name="phoneno"
            :value="old('phoneno')" required autocomplete="phoneno" />
    </div>

    <div class="mt-4">
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="new-password" />
    </div>

    <div class="mt-4">
        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
            required autocomplete="new-password" />
    </div>

    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
    <div class="mt-4">
        <x-label for="terms">
            <div class="flex items-center">
                <x-checkbox name="terms" id="terms" required />

                <div class="ms-2">
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms
                        of Service').'</a>',
                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy
                        Policy').'</a>',
                    ]) !!}
                </div>
            </div>
        </x-label>
    </div>
    @endif

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-button class="ms-4">
            {{ __('Register') }}
        </x-button>
    </div>
</form> --}}