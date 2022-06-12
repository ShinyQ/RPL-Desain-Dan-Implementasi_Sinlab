@extends('layout.main')
@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div style="width: 100%; height: 350px" id='myDiv'></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div style="width: 100%; height: 350px" id='myDiv2'></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="font-size: 18px">Pengembalian Barang Terdekat</h4>
                    </div>
                    <div class="card-body">
                        <table class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor handphone</th>
                                    <th scope="col">Tangal Pengembalian</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deadline as $key => $val)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $val->user->name }}</td>
                                        <td>{{ $val->user->phone }}</td>
                                        <td>{{ $val->deadline }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="transaction}">
                                                Konfirmasi Pengembalian
                                            </a> &nbsp;
                                            <a class="btn btn-outline-primary" href="transaction/{{ $val->id }}">
                                                Detail
                                            </a>
                                            &nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdn.plot.ly/plotly-2.8.3.min.js'></script>

    <script>
        const trace0 = {
            x: ['2022-03-15', '2022-03-16', '2022-03-17', '2022-03-18', '2022-03-19'],
            y: [2, 5, 3, 10, 4],
            type: 'line',
            name: 'Peminjaman'
        };

        const trace1 = {
            x: ['2022-03-15', '2022-03-16', '2022-03-17', '2022-03-18', '2022-03-19'],
            y: [6, 9, 4, 6, 5],
            type: 'line',
            name: 'Pengembalian'
        };

        const data = [trace0, trace1];

        const layout = {
            title: 'Grafik Transaksi Inventaris',
            xaxis: {
                title: 'Tanggal'
            },
            yaxis: {
                title: 'Jumlah'
            }
        };

        Plotly.newPlot('myDiv', data, layout, {
            responsive: true
        });
    </script>

    <script>
        const trace2 = {
            x: ['Mac Book Pro 11', 'Arduino X', 'Pamflet', 'Apple 11'],
            y: [2, 5, 3, 10],
            type: 'bar',
            name: 'Grafik Peminjaman'
        };

        const data1 = [trace2];

        const layout1 = {
            title: 'Grafik Barang Dipinjam Terbanyak',
            yaxis: {
                title: 'Jumlah'
            },

        };

        Plotly.newPlot('myDiv2', data1, layout1, {
            responsive: true
        });
    </script>
@endsection
