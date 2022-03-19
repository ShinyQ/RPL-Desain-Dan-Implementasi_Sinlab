@extends('layout.main')
@section('content')
    <div class="section-header">
        <div class="aligns-items-center d-inline-block">
            <a href="{{ url('/') }}">
                <i class="h5 fa fa-arrow-left"></i>
            </a>
            <h1>{{ $title }}</h1>
        </div>
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
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="text" placeholder="081xxx" class="form-control" value="{{ Auth::user()->phone }}" required="">
                                    <div class="invalid-feedback">
                                        Please fill the phone
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Upload KTM</label>
                                    <div class="input-group d-flex justify-content-center">

                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" accept="image/*" name="photo" id="image-upload" />
                                        </div>
                                    </div>
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
@endsection

@push('scripts')
    <script>
        $("select").selectric();
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $(".inputtags").tagsinput('items');
    </script>
@endpush
