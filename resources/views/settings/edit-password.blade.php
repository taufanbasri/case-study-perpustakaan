@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Beranda</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Edit Password</li>
            </ol>
          </nav>
          <div class="card">
              <div class="card-header">Edit Password</div>
              <div class="card-body">
                <form action="{{ route('password.update') }}" method="post">
                  @csrf
                  <div class="form-group row">
                      <label for="password" class="col-sm-4 col-form-label text-md-right">Password Lama</label>

                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autofocus>

                          @if ($errors->has('password'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="new_password" class="col-sm-4 col-form-label text-md-right">Password Baru</label>

                      <div class="col-md-6">
                          <input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password">

                          @if ($errors->has('new_password'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('new_password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="new_password_confirmation" class="col-sm-4 col-form-label text-md-right">Konfirmasi Password Baru</label>

                      <div class="col-md-6">
                          <input id="new_password_confirmation" type="password" class="form-control{{ $errors->has('new_password_confirmation') ? ' is-invalid' : '' }}" name="new_password_confirmation">

                          @if ($errors->has('new_password_confirmation'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
