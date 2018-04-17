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
              <li class="breadcrumb-item active" aria-current="page">Penulis</li>
            </ol>
          </nav>
          <div class="card">
              <div class="card-header">Penulis
                <a class="btn btn-primary pull-right" href="{{ route('authors.create') }}">Tambah</a>
              </div>

              <div class="card-body">
                {!! $html->table(['class' => 'table-striped']) !!}
              </div>
          </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
  {!! $html->scripts() !!}
@endpush
