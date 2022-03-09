@extends('layout.main')
@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('item/create') }}" class="btn btn-primary">+ Tambah Barang Inventaris</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-md">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Tanggal Dibuat</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img width="100" src="{{ $item->photo }}" alt=""></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="#" class="btn btn-secondary">Detail</a>
                            </td>
                        </tr>
                        @empty
                            Data Masih Kosong
                        @endforelse
                        </tbody></table>
                </div>
            </div>  `
        </div>
    </div>
@endsection
