<!DOCTYPE html>
<html>
<head>
<style>
#laporan {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#laporan td, #laporan th {
  border: 1px solid #ddd;
  padding: 8px;
}

#laporan tr:nth-child(even){background-color: #f2f2f2;}

#laporan tr:hover {background-color: #ddd;}

#laporan th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Laporan Request</h1>

<table id="laporan">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Tanggal Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->qty }}</td>
                <td>
                    @if ($item->status == 'Diterima')
                        <div class="badge badge-success">{{ $item->status }}</div>
                    @elseif ($item->status == 'Ditolak')
                        <div class="badge badge-danger">{{ $item->status }}</div>
                    @else
                        <div class="badge badge-warning">{{ $item->status }}</div>
                    @endif
                </td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @empty
            Data Masih Kosong
        @endforelse
        
    </tbody>
</table>

</body>
</html>


