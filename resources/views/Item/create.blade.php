@extends('layout.main')
@section('content')
    <div class="section-header">
        <a href="{{ url('item') }}"><i style="font-size: 20px" class="fa fa-arrow-left"></i></a> &nbsp;&nbsp;&nbsp;<h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Barang</label>
                                <textarea style="height:100px" class="form-control" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <input type="number" min="1" class="form-control" name="qty">
                            </div>
                            <input style="float: right" class="btn btn-primary" type="button" value="Tambah Data">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Upload Gambar Barang</h5>
                        </div>
                        <div class="card-body">
                            <div style="text-align: center">
                                <img src="" width="300px" id="preview" style="margin-bottom: 2%">
                                <input name="photo" type="file" id="filetag">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        var fileTag = document.getElementById("filetag"),
            preview = document.getElementById("preview");

        fileTag.addEventListener("change", function() {
            changeImage(this);
        });

        function changeImage(input) {
            var reader;

            if (input.files && input.files[0]) {
                reader = new FileReader();

                reader.onload = function(e) {
                    preview.setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
