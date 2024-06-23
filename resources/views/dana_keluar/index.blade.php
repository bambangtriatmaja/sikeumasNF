@extends('layouts.main')

@section('container')
    <div class="pt-3 pb-2 mb-3 border-bottom">
      <h2>Dana Keluar</h2>
    </div>
    <div class="card">
      <div class="card-body">
        <h6>Dana Keluar Selama 7 Hari Terakhir</h6>
        <h5>Total: Rp. {{ number_format($totalLast7Days) }}</h5>
      </div>
    </div>
      
      <!-- START DATA -->
      <div class="my-3 p-3 bg-body rounded shadow-sm">
              <!-- FORM PENCARIAN -->
              <div class="pb-3">
                <form class="d-flex" action="{{ url('dana_keluar') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </form>
              </div>
              
              <!-- TOMBOL TAMBAH DATA -->
              <div class="pb-3">
                <a href='{{ url('dana_keluar/create') }}' class="btn btn-primary">+ Tambah Data</a>
              </div>
              @include('components.pesan')
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="col-md-1">Tanggal</th>
                          <th class="col-md-1">Pengeluaran</th>
                          <th class="col-md-2">Keterangan Pengeluaran</th>
                          <th class="col-md-2">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                    <tr>
                      <td>{{ $item->tanggal }}</td>
                      <td>{{ $item->formatRupiah('nominal') }}</td>
                      <td>{{ $item->ket_pengeluaran }}</td>
                      <td>
                          <a href='{{ url('dana_keluar/'.$item->tanggal.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                          <form onsubmit="return confirm('Apakah yakin ingin menghapus data?')" class="d-inline" action="{{ url('dana_keluar/'.$item->tanggal) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                          </form>
                          </form>
                      </td>
                  </tr>
                    @endforeach
                        
                  </tbody>
              </table>
              {{ $data->links() }}
        </div>
        <!-- AKHIR DATA -->

@endsection