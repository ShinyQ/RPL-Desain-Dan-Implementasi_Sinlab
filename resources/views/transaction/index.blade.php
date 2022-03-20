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
                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table-md table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Peminjam</th>
                                <th>nama barang</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th>Feedback</th>
                                <th>qty</th>
                                <th>tanggal pinjam</th>
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
                                    <!-- nama peminjam -->
                                    <td>Michael Warning</td>
                                    <!-- nama barang -->
                                    <td>Router Foresty</td>
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
                                    <td>2</td>
                                    <td>21-April-2022</td>
                                    @if (auth()->user()->role == 'super_user')
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->status == 'Menunggu Persetujuan')
                                                <button class="btn btn-primary btn-process" data-id="{{ $item->id }}">Proses</button>
                                            @else
                                                Selesai
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> `
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
                    url: `request/${id}/edit`,
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
        });
    </script>
@endpush
