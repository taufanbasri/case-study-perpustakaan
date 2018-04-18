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
          <li class="breadcrumb-item active" aria-current="page">Ubah Penulis</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header">Ubah Penulis</div>

        <div class="card-body">
          <form class="form-inline" action="{{ route('authors.update', $author->id) }}" method="post">
            @csrf
            @method('PATCH')

            @include('authors._form')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
