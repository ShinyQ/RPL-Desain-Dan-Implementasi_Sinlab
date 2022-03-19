@extends('layout.main')
@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="card">
            @if(auth()->user()->role == 'super_user')
            <div class="card-header">
                    <a href="{{ url('request/create') }}" class="btn btn-primary">+ Tambah Barang Inventaris</a>
            </div>
            @endif
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
                            @if(auth()->user()->role == 'super_user')
                                <th>Tanggal Dibuat</th>
                            @endif
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
                            @if(auth()->user()->role == 'super_user')
                                <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="#" class="btn btn-primary">Edit</a>
                            </td>
                            @else
                                <td>
                                    <a href="#" class="btn btn-primary">Pinjam</a>
                                </td>
                            @endif
                        </tr>
                        @empty
                            Data Masih Kosong
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
