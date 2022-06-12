@extends('layout.main')
@section('content')
    <div class="section-header">
        <div class="aligns-items-center d-inline-block">
            <h1>{{ $title }}</h1>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($message = Session::get('failed'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                @if (auth()->user()->role == 'super_user')
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ url('item/create') }}" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i>&nbsp; Tambah Barang Inventaris</a>
                        <a class="btn btn-success btn-export" href="#">Export PDF</a>
                    </div>
                @else
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ url('transaction/create') }}" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Pinjam Barang</a>
                        @if (auth()->user()->role == 'user')
                            <button class="btn btn-icon icon-left btn-primary" id="btnRequest"><i class="fa fa-comment"></i> Ajukan Inventaris</button>
                        @endif
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table-md table">
                        <thead>
                            <tr>
                                @if (auth()->user()->role != 'super_user')
                                    <th class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                @endif
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                                @if (auth()->user()->role == 'super_user')
                                    <th>Tanggal Dibuat</th>
                                    <th width="110px">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $key => $item)
                                <tr>
                                    @if (auth()->user()->role != 'super_user')
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-{{ $key + 1 }}">
                                                <label for="checkbox-{{ $key + 1 }}" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                    @endif
                                    <td>{{ $key + 1 }}</td>
                                    @if (substr("$item->photo", 0, 5) == 'https')
                                        <td><img width="100" src="{{ $item->photo }}" alt=""></td>
                                    @else
                                        <td><img width="100" src="{{ asset('assets/images/item/' . $item->photo) }}" alt=""></td>
                                    @endif
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->qty }}</td>
                                    @if (auth()->user()->role == 'super_user')
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/item/' . $item->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                            <a href="#" data-id="{{ $item->id }}" class="btn btn-outline-primary delete" data-toggle="modal" data-target="#deleteModal">Hapus
                                            </a>
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

    <script>
        $(document).on('click', '.delete', function() {
            let id = $(this).attr('data-id');
            $('#deleteForm').attr('action', '/admin/item/' + id);
        });
    </script>
@endsection

<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="post">

                @csrf
                @method('DELETE')
                <p style="font-size: 16px" class="text-center">Apakah Anda Yakin Ingin Menghapus Item?</p>


                <div class="modal-footer" style="padding-top: 5px">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade show" tabindex="-1" role="dialog" id="modalRequest">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRequestTitle">Saran Inventaris</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formReview" data-id="">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="namaBarang" placeholder="nama barang">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Barang</label>
                        <div class="input-group">
                            <textarea class="form-control h-25" id="deskripsiBarang" rows="3" placeholder="deskripsi barang"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Barang</label>
                        <div class="input-group w-50">
                            <div class="input-group-prepend">
                                <button class="btn btn-primary" type="button" id="decQty" disabled><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </div>
                            <input type="text" class="form-control" id="qtyBarang" placeholder="1" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="incQty"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnAjukan">Ajukan</button>
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


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#btnRequest').on('click', function(event) {
                $('#modalRequest').modal('show');
                $('#namaBarang').val('')
                $('#deskripsiBarang').val('')
                $('#qtyBarang').val('1')
            });
            $('#decQty').on("click", function(event) {
                let current = parseInt($('#qtyBarang').val())
                $('#qtyBarang').val(current - 1 > 1 ? --current : 1);
                if (current - 1 <= 1) {
                    $('#decQty').attr("disabled", true);
                }
            })
            $('#incQty').on("click", function(event) {
                let current = parseInt($('#qtyBarang').val())
                $('#qtyBarang').val(++current);
                $('#decQty').attr("disabled", false);
            })
            $('#btnAjukan').on("click", function(event) {
                $.ajax({
                    url: `request`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    data: {
                        name: $('#namaBarang').val(),
                        description: $('#deskripsiBarang').val(),
                        qty: $('#qtyBarang').val(),
                    },
                    success: function(data) {
                        $('#modalRequest').toggleClass('modal-progress');
                        location.reload();
                    },
                    error: function(data) {
                        $('#modalRequest').toggleClass('modal-progress');
                        alert('Internal Server Error');
                    }

                });
            })

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
                window.open(`item/export_pdf?fromDate=${from_date}&toDate=${to_date}`, 'name');
            });

        });
    </script>
@endpush
