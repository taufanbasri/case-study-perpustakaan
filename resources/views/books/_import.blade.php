<div class="form-group row">
    <label class="col-sm-4 col-form-label text-md-right">Gunakan template terbaru</label>
    <div class="col-md-6">
        <a class="btn btn-xs btn-success" href="{{ route('template.books') }}">Download</a>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-4 col-form-label text-md-right">Pilih file</label>
    <div class="col-md-6">
        <input id="excel" type="file" class="form-control{{ $errors->has('excel') ? ' is-invalid' : '' }}" name="excel" value="{{ old('excel') }}">

        @if ($errors->has('excel'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('excel') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
  <div class="col-md-4"></div>
  <div class="col-md-6">
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>
