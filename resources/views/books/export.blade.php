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
            <a href="{{ route('books.index') }}">Buku</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Export Buku</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header">Export Buku</div>

        <div class="card-body">
            <form class="" action="{{ route('export.books.post') }}" method="post" enctype="multipart/form-data"  target="_blank">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">Penulis</label>
                    <div class="col-md-6">
                        <select class="form-control{{ $errors->has('author_id') ? ' is-invalid' : '' }} js-selectize" name="author_id[]" multiple autofocus placeholder="Pilih Penulis">
                            @foreach ($authors as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('author_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('author_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="type" class="col-sm-4 col-form-label text-md-right">Pilih Output</label>
                    <div class="col-md-6">
                      <div class="radio {{ $errors->has('type') ? ' is-invalid' : '' }}">
                        <label><input type="radio" name="type" value="xls">Excel</label>
                        <label><input type="radio" name="type" value="pdf">PDF</label>
                      </div>

                        @if ($errors->has('type'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"></div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Download</button>
                  </div>
                </div>

              </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
