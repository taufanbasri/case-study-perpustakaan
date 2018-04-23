@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Daftar Buku
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
