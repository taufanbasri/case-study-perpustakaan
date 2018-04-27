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
              <li class="breadcrumb-item">
                <a href="{{ route('profile') }}">Profile</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
          </nav>
          <div class="card">
              <div class="card-header">Edit Profile</div>
              <div class="card-body">
                <form action="{{ route('profile.update') }}" method="post">
                  @csrf
                  <div class="form-group row">
                      <label for="email" class="col-sm-4 col-form-label text-md-right">Nama</label>

                      <div class="col-md-6">
                          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ auth()->user()->name }}" autofocus>

                          @if ($errors->has('name'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="email" class="col-sm-4 col-form-label text-md-right">Alamat Email</label>

                      <div class="col-md-6">
                          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ auth()->user()->email }}">

                          @if ($errors->has('email'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('email') }}</strong>
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
