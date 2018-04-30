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
          <li class="breadcrumb-item active" aria-current="page">Tambah Buku</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header">Tambah Buku</div>

        <div class="card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="input-tab" data-toggle="tab" href="#input" role="tab" aria-controls="input" aria-selected="true">Input</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="false"><i class="fa fa-upload"></i> Upload</a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="input" role="tabpanel" aria-labelledby="input-tab">
                <form class="" action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group form-inline">
                    <label class="col-2 control-label">Judul</label>
                    <div class="col-10">
                      <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="Judul Buku" autofocus>
                      @if ($errors->has('title'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('title') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group form-inline">
                    <label class="col-2 control-label">Penulis</label>
                    <div class="col-10">
                      <select class="form-control js-selectize {{ $errors->has('author_id') ? ' is-invalid' : '' }}" name="author_id">
                        <option>--Pilih Penulis--</option>
                        @foreach ($authors as $author)
                          <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('author_id'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('author_id') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group form-inline">
                    <label class="col-2 control-label">Jumlah</label>
                    <div class="col-10">
                      <input type="number" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" placeholder="Jumlah Buku" autofocus>
                      @if ($errors->has('amount'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('amount') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group form-inline">
                    <label class="col-2 control-label">Cover</label>
                    <div class="col-10">
                      <input type="file" class="form-control" name="cover" value="{{ old('cover') }}" placeholder="Judul Buku" autofocus>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-4 col-md-offset-2">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </form>
            </div>

            <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                <form class="" action="{{ route('import.books.excel') }}" method="post" enctype="multipart/form-data">
                  @csrf

                  @include('books._import')
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
