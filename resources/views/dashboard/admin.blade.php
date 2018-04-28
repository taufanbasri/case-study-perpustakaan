@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
          Selamat datang Admin!!
          <hr>
          <h4>Statistik Penulis</h4>
          <canvas id="chartPenulis" width="400" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="{{ asset('js/Chart.min.js') }}"></script>

  <script>
    var dataChart = {
      labels: {!! json_encode($authors) !!},
      datasets: [{
        label: 'Jumlah Buku',
        data: {!! json_encode($books) !!},
        backgroundColor: "rgba(151,187,205,0.5)",
        borderColor: "rgba(151,187,205,0.8)",
      }]
    };

    var options = {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      }
    };

    var ctx = document.getElementById("chartPenulis").getContext("2d");

    var authorChart = new Chart(ctx, {
      type: 'polarArea',
      data: dataChart,
      option: options
    });
  </script>
@endpush
