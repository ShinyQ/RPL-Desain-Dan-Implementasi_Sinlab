@extends('layout.main')
@section('content')
    <div class="section-header">
        <div class="aligns-items-center d-inline-block">
            <h1>{{ $title }}</h1>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                @if (auth()->user()->role == 'super_user')
                    <div class="card-header d-flex justify-content-between">
                        <a></a>
                        <a class="btn btn-success btn-export" href="#">Export PDF</a>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table-md table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Peminjam</th>
                                <th>Status</th>
                                <th>Tanggal Pinjam</th>
                                <th>Deadline</th>
                                <th>Feedback</th>
                                @if (auth()->user()->role == 'super_user')
                                    <th>Tanggal Dibuat</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        @if ($item->status == 'Diterima')
                                            <div class="badge badge-success">{{ $item->status }}</div>
                                        @elseif ($item->status == 'Ditolak')
                                            <div class="badge badge-danger">{{ $item->status }}</div>
                                        @elseif ($item->status == 'Selesai')
                                            <div class="badge badge-info">{{ $item->status }}</div>
                                        @else
                                            <div class="badge badge-warning">{{ $item->status }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->deadline }}</td>
                                    <td>{{ $item->feedback }}</td>
                                    @if (auth()->user()->role == 'super_user')
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ URL('transaction/' . $item->id) }}" class="btn btn-outline-primary btn-detail mr-1" data-id="{{ $item->id }}">Detail</a>
                                                @if ($item->status == 'Menunggu Persetujuan')
                                                    <button class="btn btn-primary btn-process" data-id="{{ $item->id }}">Proses</button>
                                                @elseif($item->status == 'Diterima')
                                                    <button class="btn btn-primary btn-konfirmasi" href="#" data-id="{{ $item->id }}">
                                                        Konfirmasi
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<div class="modal fade show" tabindex="-1" role="dialog" id="modalprocess">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalprocessTitle">process</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formprocess" data-id="">

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="statusBarang" disabled="true">
                            <option>Menunggu Persetujuan</option>
                            <option>Diterima</option>
                            <option>Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Feedback</label>
                        <div class="input-group">
                            <textarea class="form-control h-25" id="feedbackRequest" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit process</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show" tabindex="-1" role="dialog" id="modalexport">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalexportTitle">export</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-id="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>From date</label>
                            <input type="text" name="from_date" id="from_date" class="form-control datetimepicker" />
                        </div>
                        <div class="form-group col-md-6">
                            <label>To date</label>
                            <input type="text" name="to_date" id="to_date" class="form-control datetimepicker" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="export">Submit export</button>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-danger fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pengembalian Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="konfirmasiForm" method="post">
                <input type="hidden" class="form-control" name="id" id="transactionId">
                <p style="font-size: 16px" class="text-center">Apakah Anda Yakin Barang Sudah Dikembalikan?</p>

                <div class="modal-footer" style="padding-top: 5px">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="btnSubmitKonfirmasi">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-process').on('click', function(event) {
                var id = $(this).data('id');
                $('#modalprocess').modal('show');
                $('#modalprocess').toggleClass('modal-progress');
                $('#formprocess').attr('action', `request/${id}/edit`);
                $('#formprocess').attr('data-id', id);
                $.ajax({
                    url: `transaction/${id}/edit`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    success: function(data) {
                        $('#statusBarang').val(data.status);
                        $('#statusBarang').attr("disabled", false);
                        $('#feedbackRequest').val(data.feedback)
                        $('#feedbackRequest').attr("readonly", false);
                        $('#modalprocess').toggleClass('modal-progress');
                        $('#btnSubmit').show();
                    },
                    error: function() {
                        $('#modalprocess').toggleClass('modal-progress');
                        alert('Internal Server Error');
                    }
                });
            });
            $('.btn-konfirmasi').on('click', function(event) {
                var id = $('.btn-konfirmasi').data('id');
                $('#transactionId').val(id);
                $('#konfirmasiModal').modal('show');
            });
            $('#btnSubmitKonfirmasi').click(function(e) {
                e.preventDefault();
                var id = $('#transactionId').val();;
                $('#konfirmasiModal').toggleClass('modal-progress');
                $.ajax({
                    url: `transaction/${id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    data: {
                        status: 'Selesai',
                        _method: "PATCH"
                    },
                    success: function(data) {
                        $('#konfirmasiModal').toggleClass('modal-progress');
                        location.reload();
                    },
                    error: function(data) {
                        $('#konfirmasiModal').toggleClass('modal-progress');
                        alert('Internal Server Error');
                    }
                });
            });
            $('#btnSubmit').click(function(e) {
                e.preventDefault();
                var id = $('#formprocess').data('id');
                $('#modalprocess').toggleClass('modal-progress');
                $.ajax({
                    url: `transaction/${id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    data: {
                        status: $('#statusBarang').val(),
                        feedback: $('#feedbackRequest').val(),
                        _method: "PATCH"
                    },
                    success: function(data) {
                        $('#modalprocess').toggleClass('modal-progress');
                        location.reload();
                    },
                    error: function(data) {
                        $('#modalprocess').toggleClass('modal-progress');
                        alert('Internal Server Error');
                    }
                });
            });

            $('.btn-export').on('click', function(event) {
                var date = new Date();

                $('#modalexport').modal('show');

                $('.input-daterange').datepicker({
                    todayBtn: 'linked',
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });
            });

            $('#export').click(function() {

                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();

                var _token = $('input[name="_token"]').val();
                window.open(`transaction/export_pdf?fromDate=${from_date}&toDate=${to_date}`, 'name');
            });

        });
    </script>
@endpush
