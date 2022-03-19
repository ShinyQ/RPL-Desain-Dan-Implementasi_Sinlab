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
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>KTM</th>
                                <th>Phone</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img width="100" src="{{ $user->photo }}" alt=""></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->ktm }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownRoleButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ Str::replace('_', ' ', $user->role) }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Guest</a>
                                                <a class="dropdown-item" href="#">User</a>
                                                <a class="dropdown-item" href="#">Super User</a>
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
