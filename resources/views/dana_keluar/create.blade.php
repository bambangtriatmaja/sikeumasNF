@extends('layouts.main')

@section('container')
  <div class="pt-3">
    <h2>Tambah Laporan Dana Keluar</h2>
  </div>
  @include('components.pesan')
  <!-- START FORM -->
    <form action='{{ url('dana_keluar') }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='tanggal' value="{{ Session::get('tanggal') }}" id="tanggal">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nominal' value="{{ Session::get('nominal') }}" id="nominal">
            </div>
        </div>
        <div class="mb-3 row">
          <label for="ket_pengeluaran" class="col-sm-2 col-form-label">Keterangan Pengeluaran</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" name='ket_pengeluaran' value="{{ Session::get('ket_pengeluaran') }}" id="ket_pengeluaran">
          </div>
      </div>
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>  
    </form>
  <!-- AKHIR FORM -->
@endsection