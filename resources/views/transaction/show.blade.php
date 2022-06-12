@extends('layout.main')
@section('content')
    <div class="section-header">
        <div class="aligns-items-center d-inline-block">
            <a href="{{ url('item') }}">
                <i class="h5 fa fa-arrow-left"></i>
            </a>
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
                                <label>Status</label>
                                <select class="form-control" id="statusBarang" disabled>
                                    <option>{{ $transaction->status }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alasan Peminjaman</label>
                                <textarea class="form-control h-25" row="3" name="reason" disabled>{{ $transaction->reason }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tanggal Peminjaman</label>
                                    <input type="text" class="form-control" disabled value="{{ $transaction->start_date }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal Pengembalian</label>
                                    <input type="text" class="form-control" disabled value="{{ $transaction->deadline }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Daftar Barang</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($items as $key => $item)
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>Qty</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="qty-{{ $key }}" name="qty[]" readonly data-id="{{ $item->id }}" value="1">
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="id-{{ $key }}" name="ids[]" value="{{ $item->id }}">
                                    <div class="form-group col-md-10">
                                        <label>Nama Barang</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="namaBarang" readonly value="{{ $item->name }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
