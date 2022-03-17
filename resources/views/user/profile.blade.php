@extends('layout.main')
@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ request()->session()->get('user')->name }}</h2>
        <p class="section-lead">
            Change information about yourself on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{ request()->session()->get('user')->photo }}" class="rounded-circle profile-widget-picture">

                    </div>
                    <div class="profile-widget-description">
                        Email: <div class="profile-widget-name">{{ request()->session()->get('user')->email }} </div>
                        Role: <div class="profile-widget-name">{{ Str::replace('_',' ',request()->session()->get('user')->role) }} </div>
                        Phone: <div class="profile-widget-name">{{ Auth::user()->phone ?? '-' }} </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form method="post" class="needs-validation" novalidate="">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Phone</label>
                                    <input type="text" placeholder="081xxx" class="form-control" value="{{ Auth::user()->phone }}" required="">
                                    <div class="invalid-feedback">
                                        Please fill the phone
                                    </div>
                                </div>
                                <div style="text-align: left">
                                    <label>Upload KTM</label>
                                    <br>
                                    <img src="" width="150px" id="preview" style="margin-bottom: 2%">
                                    <br>
                                    <input name="photo" type="file" id="filetag">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
