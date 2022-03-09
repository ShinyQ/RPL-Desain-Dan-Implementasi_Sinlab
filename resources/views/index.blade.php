@extends('layout.main')
@section('content')
    <div class="section-header">
        <h1>Blank Page</h1>
    </div>

    <div class="section-body">
        {{ session()->get('user') }}
        {{ session()->get('success') }}
    </div>
@endsection
