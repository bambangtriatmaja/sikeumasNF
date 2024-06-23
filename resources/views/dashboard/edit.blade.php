@extends('layouts.main')

@section('container')
  <h1 class="h2">Edit Laporan</h1>
  @include('components.pesan')
  <!-- START FORM -->
    <form action='{{ url('dashboard/'.$data->tanggal) }}' method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='tanggal' value="{{ $data->tanggal }}" id="tanggal">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="infaq" class="col-sm-2 col-form-label">Infaq</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='infaq' value="{{ $data->infaq }}" id="infaq">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="pengeluaran" class="col-sm-2 col-form-label">Pengeluaran</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='pengeluaran' value="{{ $data->pengeluaran }}" id="pengeluaran">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="ketPengeluaran" class="col-sm-2 col-form-label">Keterangan Pengeluaran</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='ket_pengeluaran' value="{{ $data->ket_pengeluaran }}" id="ket_pengeluaran">
            </div>
        </div>
        <div class="mb-3 row">
        <label for="saldoAkhir" class="col-sm-2 col-form-label">Saldo Akhir</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name='saldo_akhir' value="{{ $data->saldo_akhir }}" id="saldo_akhir">
        </div>
    </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>  
    </form>
  <!-- AKHIR FORM -->
@endsection