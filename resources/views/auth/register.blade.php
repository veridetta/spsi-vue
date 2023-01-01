@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-2 ">
    <div class="col-9 row my-2">
      <!-- Register Basic -->
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
          <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="col-12 row my-2 justify-content-center">
              <div class="col-6">
                <div class="mb-1">
                  <label for="register-username" class="form-label">Username</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-username" name="username" placeholder="johndoe" aria-describedby="register-username" tabindex="1" autofocus value="{{ old('username') }}" />
                  @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-email" class="form-label">Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="register-email"
                    name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2"
                    value="{{ old('email') }}" />
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-name" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-name"
                    name="name" placeholder="James Kardun" aria-describedby="register-name" tabindex="2"
                    value="{{ old('name') }}" />
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-card" class="form-label">NIK</label>
                  <input type="text" class="form-control @error('nik') is-invalid @enderror" id="register-nik"
                    name="nik" placeholder="1332xxx" aria-describedby="register-nik" tabindex="2"
                    value="{{ old('nik') }}" />
                  @error('nik')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-divisi" class="form-label">Divisi</label>
                  <input type="text" class="form-control @error('divisi') is-invalid @enderror" id="register-divisi"
                    name="divisi" placeholder="Humas" aria-describedby="register-divisi" tabindex="2"
                    value="{{ old('divisi') }}" />
                  @error('divisi')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-password" class="form-label">Password</label>
    
                  <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                    <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror"
                      id="register-password" name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="register-password" tabindex="3" />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
    
                <div class="mb-1">
                  <label for="register-password-confirm" class="form-label">Confirm Password</label>
    
                  <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" id="register-password-confirm"
                      name="password_confirmation"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="register-password" tabindex="3" />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="mb-1">
                  <label for="register-card" class="form-label">ID Card</label>
                  <input type="text" class="form-control @error('card') is-invalid @enderror" id="register-card"
                    name="card" placeholder="1332xxx" aria-describedby="register-card" tabindex="2"
                    value="{{ old('card') }}" />
                  @error('card')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-no_telp" class="form-label">No Telp</label>
                  <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="register-no_telp"
                    name="no_telp" placeholder="088xxxx" aria-describedby="register-no_telp" tabindex="2"
                    value="{{ old('no_telp') }}" />
                  @error('no_telp')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-alamat" class="form-label">Alamat</label>
                  <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" id="register-alamat"
                    name="alamat" placeholder="Alamat Lengkap" aria-describedby="register-alamat" tabindex="2"
                    value="{{ old('alamat') }}" ></textarea>
                  @error('alamat')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-agama" class="form-label">Agama</label>
                  <select  class="select2 form-select form-control @error('agama') is-invalid @enderror" id="register-agama"
                    name="agama" placeholder="Agama" aria-describedby="register-agama" tabindex="2"
                    value="{{ old('agama') }}" >
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                  </select>
                  @error('agama')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-jk" class="form-label">Jenis Kelamin</label>
                  <select  class="select2 form-select form-control @error('jk') is-invalid @enderror" id="register-jk"
                    name="jk" placeholder="Jenis Kelamin" aria-describedby="register-jk" tabindex="2"
                    value="{{ old('jk') }}" >
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                  </select>
                  @error('jk')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control @error('lahir') is-invalid @enderror" id="register-lahir"
                    name="lahir" placeholder="12/02/1993" aria-describedby="register-lahir" tabindex="2"
                    value="{{ old('lahir') }}" />
                  @error('lahir')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-masuk" class="form-label">Tanggal Masuk</label>
                  <input type="date" class="form-control @error('masuk') is-invalid @enderror" id="register-masuk"
                    name="masuk" placeholder="12/02/2022" aria-describedby="register-masuk" tabindex="2"
                    value="{{ old('masuk') }}" />
                  @error('masuk')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
              <div class="mb-1">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms" name="terms" tabindex="4" />
                  <label class="form-check-label" for="terms">
                    I agree to the <a href="{{ route('terms.show') }}" target="_blank">terms_of_service</a> and
                    <a href="{{ route('policy.show') }}" target="_blank">privacy_policy</a>
                  </label>
                </div>
              </div>
            @endif
            <button type="submit" class="btn btn-primary w-100" tabindex="5">Sign up</button>
          </form>

          <p class="text-center mt-2">
            <span class="text-black">Already have an account?</span>
            @if (Route::has('login'))
              <a href="{{ route('login') }}">
                <span>Sign in instead</span>
              </a>
            @endif
          </p>
      <!-- /Register basic -->
    </div>
  </div>
@endsection
