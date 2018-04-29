<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Data Buku</title>
  </head>
  <body>
    <h1>Data Buku Perpustakaan</h1>
    <hr>
    <table>
      <thead>
        <tr>
          <td>Judul</td>
          <td>Jumlah</td>
          <td>Stok</td>
          <td>Penulis</td>
        </tr>
      </thead>
      <tbody>
        @forelse ($books as $book)
          <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->amount }}</td>
            <td>{{ $book->stock }}</td>
            <td>{{ $book->author->name }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" align="center">Data tidak ditemukan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </body>
</html>
