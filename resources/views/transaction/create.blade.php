@extends('layout.main')
@section('content')
    <div class="section-header">
        <div class="aligns-items-center d-inline-block">
            <a href="{{ url('item') }}">
                <i class="h5 fa fa-arrow-left"></i>
            </a> &nbsp; &nbsp;
            <h1>{{ $title }}</h1>
        </div>
    </div>

    <div class="section-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Peminjam</label>
                                <input type="text" class="form-control" name="name" disabled value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label>Alasan Peminjaman</label>
                                <textarea class="form-control h-25" row="3" name="description"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tanggal Peminjaman</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal Pengembalian</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <input class="btn btn-primary float-right" type="submit" value="Ajukan">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Daftar Barang</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Barang 1
                                    <span class="badge badge-primary badge-pill">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Barang 2
                                    <span class="badge badge-primary badge-pill">2</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Barang 3
                                    <span class="badge badge-primary badge-pill">1</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
