@extends('layouts/fullLayoutMaster')

@section('title', '2 Factor Chanllenge')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
      <!-- Login basic -->
      <div class="card mb-0">
        <div class="card-body">
          <div class="brand-logo">
            <div class="avatar">
              <img
                src="{{asset('images/logo/logo.png')}}"
                alt="avatar"
                width="60"
                height="60"
              />
            </div>
            <div class="avatar">
              <img
                src="{{asset('images/logo/spsi.png')}}"
                alt="avatar"
                width="60"
                height="60"
              />
            </div>
          </div>
          <a href="#" class="brand-logo">
            <h2 class="brand-text text-primary ms-1">SERIKAT SPSI</h2>
          </a>


          <div x-data="{ recovery: false }">
            <div class="mb-1" x-show="! recovery">
              {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-1" x-show="recovery">
              {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-jet-validation-errors class="mb-1" />

            <form method="POST" action="{{ route('two-factor.login') }}">
              @csrf

              <div class="mb-1" x-show="! recovery">
                <x-jet-label class="form-label" value="{{ __('Code') }}" />
                <x-jet-input class="{{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" inputmode="numeric"
                  name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                <x-jet-input-error for="code"></x-jet-input-error>
              </div>

              <div class="mb-1" x-show="recovery">
                <x-jet-label class="form-label" value="{{ __('Recovery Code') }}" />
                <x-jet-input class="{{ $errors->has('recovery_code') ? 'is-invalid' : '' }}" type="text"
                  name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                <x-jet-input-error for="recovery_code"></x-jet-input-error>
              </div>

              <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-outline-secondary me-1" x-show="! recovery"
                  x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus()})">{{ __('Use a recovery code') }}
                </button>

                <button type="button" class="btn btn-outline-secondary me-1" x-show="recovery"
                  x-on:click=" recovery = false; $nextTick(() => { $refs.code.focus() })">
                  {{ __('Use an authentication code') }}
                </button>

                <x-jet-button>
                  {{ __('Log in') }}
                </x-jet-button>
              </div>
            </form>
          </div>

          <div class="divider my-2">
            <div class="divider-text">or</div>
          </div>

          <div class="auth-footer-btn d-flex justify-content-center">
            <a href="#" class="btn btn-facebook">
              <i data-feather="facebook"></i>
            </a>
            <a href="#" class="btn btn-twitter white">
              <i data-feather="twitter"></i>
            </a>
            <a href="#" class="btn btn-google">
              <i data-feather="mail"></i>
            </a>
            <a href="#" class="btn btn-github">
              <i data-feather="github"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
