@extends('layouts.main')

@section('container')
    <div class="pt-3 pb-2 mb-3 border-bottom">
      <h2>Dana Keluar</h2>
    </div>
      
      <!-- START DATA -->
      <div class="my-3 p-3 bg-body rounded shadow-sm">
              <!-- FORM PENCARIAN -->
              <div class="pb-3">
                <form class="d-flex" action="{{ url('dashboard') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </form>
              </div>
              
              <!-- TOMBOL TAMBAH DATA -->
              <div class="pb-3">
                <a href='{{ url('create') }}' class="btn btn-primary">+ Tambah Data</a>
              </div>
              @include('components.pesan')
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="col-md-2">Tanggal</th>
                          <th class="col-md-1">Pengeluaran</th>
                          <th class="col-md-2">Keterangan Pengeluaran</th>
                          <th class="col-md-2">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                        <tr>
                          <td>2024-06-22</td>
                          <td>500000</td>
                          <td>Operasional</td>
                          <td>
                              <a href='' class="btn btn-warning btn-sm">Edit</a>
                              <form onsubmit="return confirm('Apakah yakin ingin menghapus data?')" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                              </form>
                          </td>
                      </tr>
                      <tr>
                        <td>2024-06-22</td>
                        <td>500000</td>
                        <td>Operasional</td>
                        <td>
                            <a href='' class="btn btn-warning btn-sm">Edit</a>
                            <form onsubmit="return confirm('Apakah yakin ingin menghapus data?')" class="d-inline" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                      <td>2024-06-22</td>
                      <td>500000</td>
                      <td>Operasional</td>
                      <td>
                          <a href='' class="btn btn-warning btn-sm">Edit</a>
                          <form onsubmit="return confirm('Apakah yakin ingin menghapus data?')" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                          </form>
                      </td>
                  </tr>
                  </tbody>
              </table>
            
        </div>
        <!-- AKHIR DATA -->

@endsection