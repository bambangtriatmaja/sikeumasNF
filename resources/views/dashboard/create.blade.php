@extends('layouts.main')

@section('container')
  <div class="pt-3">
    <h2>Tambah Laporan</h2>
  </div>
  @include('components.pesan')
  <!-- START FORM -->
    <form action='{{ url('dashboard') }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='tanggal' value="{{ Session::get('tanggal') }}" id="tanggal">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="infaq" class="col-sm-2 col-form-label">Infaq</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='infaq' value="{{ Session::get('infaq') }}" id="infaq">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="pengeluaran" class="col-sm-2 col-form-label">Pengeluaran</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='pengeluaran' value="{{ Session::get('pengeluaran') }}" id="pengeluaran">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="ketPengeluaran" class="col-sm-2 col-form-label">Keterangan Pengeluaran</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='ket_pengeluaran' value="{{ Session::get('ket_pengeluaran') }}" id="ket_pengeluaran">
            </div>
        </div>
        <div class="mb-3 row">
        <label for="saldoAkhir" class="col-sm-2 col-form-label">Saldo Akhir</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name='saldo_akhir' value="{{ Session::get('saldo_akhir') }}" id="saldo_akhir">
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