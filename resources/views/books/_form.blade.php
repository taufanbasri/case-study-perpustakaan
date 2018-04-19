<div class="form-group form-inline">
  <label for="name" class="col-2 control-label">Judul</label>
  <div class="col-10">
    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="@if (Route::is('authors.edit')) {{ $author->name }} @else {{ old('name') }} @endif" autofocus>
    @if ($errors->has('name'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
  </div>
</div>

<div class="form-group">
  <div class="col-md-4 col-md-offset-2">
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>
