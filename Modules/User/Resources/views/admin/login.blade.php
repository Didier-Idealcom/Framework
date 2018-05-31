@extends('layouts.master')

@section('title', 'Login')

@section('content')
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url({{ themes('app/media/img//bg/bg-1.jpg') }});">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="{{ themes('app/media/img/logos/logo-1.png') }}">
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">Sign In To Admin</h3>
                    </div>
                    <form class="m-login__form m-form" method="POST" action="{{ route('admin.login') }}">
                        {{ csrf_field() }}

                        <div class="form-group m-form__group {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <input class="form-control m-input" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                            <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group m-form__group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <input class="form-control m-input m-login__form-input--last" type="password" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                            <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox m-checkbox--light">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Remember me
                                    <span></span>
                                </label>
                            </div>
                            <div class="col m--align-right m-login__form-right">
                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                    Forget Password ?
                                </a>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
                <div class="m-login__forget-password">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Forgotten Password ?
                        </h3>
                        <div class="m-login__desc">
                            Enter your email to reset your password:
                        </div>
                    </div>
                    <form class="m-login__form m-form" action="">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" name="email" id="m_email" placeholder="Email" required>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_forget_password_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                Request
                            </button>
                            &nbsp;&nbsp;
                            <button id="m_login_forget_password_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->
@stop

@push('scripts')
<!--begin::Page Snippets -->
<script src="{{ themes('snippets/custom/pages/user/login.js') }}" type="text/javascript"></script>
<!--end::Page Snippets -->
@endpush
