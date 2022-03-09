@extends('layout.main')
@section('content')
    <div class="section-header">
        <a href="{{ url('item') }}"><i style="font-size: 20px" class="fa fa-arrow-left"></i></a> &nbsp;&nbsp;&nbsp;<h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Default Input Text</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phone Number (US Format)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control phone-number">
                                </div>
                            </div>
                            <input style="float: right" class="btn btn-primary" type="button" value="Tambah Data">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div style="text-align: center">
                                <img width="200" id="blah" src="#" alt="your image" /> <br><br>
                                <input class="form-control" accept="image/*" type='file' id="imgInp" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
