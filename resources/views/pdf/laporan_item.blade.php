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

<h1>Laporan Item</h1>

<table id="laporan">
    <thead>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nama Barang</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th>Tanggal Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $key => $item)
            <tr>
                @if (auth()->user()->role != 'super_user')
                    <td>
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-{{ $key + 1 }}">
                            <label for="checkbox-{{ $key + 1 }}" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>
                @endif
                <td>{{ $key + 1 }}</td>
                @if(substr("$item->photo",0,5) == "https")
                    <td><img width="100" src="{{ $item->photo }}" alt=""></td>
                @else
                    <td><img width="100" src="{{ asset('assets/images/item/'. $item->photo) }}" alt=""></td>
                @endif
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @empty
            Data Masih Kosong
        @endforelse
        
    </tbody>
</table>

</body>
</html>


