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
            <a href="{{ route('members.index') }}">Member</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">{{ $member->name }}</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header">{{ $member->name }}</div>

        <div class="card-body">
          <p>Buku yang sedang dipinjam:</p>
          <table class="table table-condensed table-striped">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Tanggal Peminjaman</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($member->borrowLogs()->borrowed()->get() as $log)
                <tr>
                  <td>{{ $log->book->title }}</td>
                  <td>{{ $log->created_at->format('d/m/Y') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="alert alert-warning text-center">No data.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-body">
          <p>Buku yang telah dikembalikan:</p>
          <table class="table table-condensed table-striped">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Tanggal Pengembalian</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($member->borrowLogs()->returned()->get() as $log)
                <tr>
                  <td>{{ $log->book->title }}</td>
                  <td>{{ $log->updated_at->format('d/m/Y') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="alert alert-warning text-center">No data.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
