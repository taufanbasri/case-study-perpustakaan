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
          <li class="breadcrumb-item active" aria-current="page">Ubah Buku</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header">Ubah Buku</div>

        <div class="card-body">
          <form class="" action="{{ route('books.update', $book->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group form-inline">
              <label class="col-2 control-label">Judul</label>
              <div class="col-10">
                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $book->title }}" autofocus>
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
                <select class="form-control {{ $errors->has('author_id') ? ' is-invalid' : '' }}" name="author_id">
                  @foreach ($authors as $author)
                    <option value="{{ $author->id }}"
                      @if($book->author_id == $author->id)
                        selected
                      @endif>
                      {{ $author->name }}
                    </option>
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
                <input type="number" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ $book->amount }}">
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
                <input type="file" class="form-control" name="cover" value="{{ old('cover') }}">
              </div>
            </div>
            <div class="form-group form-inline">
              <div class="col-2"></div>
              <div class="col-10">
                @if ($book->cover)
                  <img src="{{ asset('cover/' . $book->cover) }}" class="img-rounded img-responsive" width="100px" height="100px">
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
