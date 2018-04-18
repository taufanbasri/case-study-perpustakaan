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
            <a href="{{ route('authors.index') }}">Penulis</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Penulis</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header">Tambah Penulis</div>

        <div class="card-body">
          <form class="form-inline" action="{{ route('authors.store') }}" method="post">
            @csrf

            <div class="form-group">
              <label for="name" class="col-md-2 control-label">Nama</label>
              <div class="col-md-10">
                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Nama Penulis" value="{{ old('name') }}" autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-4 col-md-offset-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
