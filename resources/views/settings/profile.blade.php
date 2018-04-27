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
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
          </nav>
          <div class="card">
              <div class="card-header">Profile</div>
              <div class="card-body">
                <table class="table">
                  <tbody>
                    <tr>
                      <td class="text-muted">Nama</td>
                      <td>{{ auth()->user()->name }}</td>
                    </tr>
                    <tr>
                      <td class="text-muted">Email</td>
                      <td>{{ auth()->user()->email }}</td>
                    </tr>
                  </tbody>
                </table>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Ubah</a>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
