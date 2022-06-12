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
                                <th>Deadline</th>
                                <th>Feedback</th>
                                <th>Tanggal Pinjam</th>
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
                                        @else
                                            <div class="badge badge-warning">{{ $item->status }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->deadline }}</td>
                                    <td>{{ $item->feedback }}</td>
                                    <td>21-April-2022</td>
                                    @if (auth()->user()->role == 'super_user')
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ URL('transaction/' . $item->id) }}" class="btn btn-outline-primary btn-detail mr-1" data-id="{{ $item->id }}">Detail</a>
                                                @if ($item->status == 'Menunggu Persetujuan')
                                                    <button class="btn btn-primary btn-process" data-id="{{ $item->id }}">Proses</button>
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
                            <option>Terima</option>
                            <option>Tolak</option>
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
            <div class="input-group input-daterange">
                <input type="text" name="from_date" id="from_date" class="form-control" />
                <div class="input-group-addon">to</div>
                <input type="text" name="to_date" id="to_date" class="form-control" />
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="export">Submit export</button>
            </div>
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
                        $('#modalprocessTitle').html(`process ${data.name}`)
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
