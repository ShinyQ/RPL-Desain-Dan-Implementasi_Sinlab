@extends('layout.main')
@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-md">
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
                        @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                @if(!$user->photo)
                                    <img width="100" src="{{ asset('assets/images/telu.jpg') }}" alt="">
                                @else
                                    <img width="100" src="{{ $user->photo }}" alt="">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->ktm }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <div class="dropdown d-inline mr-2">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Str::replace('_',' ',request()->session()->get('user')->role) }}
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                      <a class="dropdown-item" href="#">Guest</a>
                                      <a class="dropdown-item" href="#">User</a>
                                      <a class="dropdown-item" href="#">Super User</a>
                                    </div>
                                  </div>
                            </td>
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
@endsection
