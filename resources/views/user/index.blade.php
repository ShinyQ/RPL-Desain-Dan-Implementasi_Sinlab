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
                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table-md table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>KTM</th>
                                <th>Phone</th>
                                <th>Tanggal Dibuat</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if(!$user->photo)
                                            <img width="100" src="{{ asset('assets/images/telu.jpg') }}" alt="Photo Profile">
                                        @else
                                            <img width="100" src="{{ $user->photo }}" alt="Photo {{ $user->name }}">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->ktm)
                                            {{ $user->ktm }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->phone)
                                            {{ $user->phone }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownRoleButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ ucfirst(Str::replace('_', ' ', $user->role)) }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('admin/update_role/'.$user->id).'/guest' }}">Guest</a>
                                                <a class="dropdown-item" href="{{ url('admin/update_role/'.$user->id).'/user' }}">User</a>
                                                <a class="dropdown-item" href="{{ url('admin/update_role/'.$user->id).'/super_user' }}">Super User</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
