<form class="float-right js-confirm" action="{{ $delete_url }}" method="post" data-confirm="{{ $confirm_message }}">
  @csrf
  @method('DELETE')

  <a href="{{ $show_url }}" class="btn btn-primary">Detail</a> |
  <a href="{{ $edit_url }}" class="btn btn-warning">Ubah</a> |
  <button type="submit" class="btn btn-danger">Hapus</button>
</form>
