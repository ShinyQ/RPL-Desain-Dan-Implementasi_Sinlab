<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $title = "Halaman Barang Inventaris";
        $items = Item::latest()->get();

        return view('item.index', compact('items', 'title'));
    }

    public function export_pdf(Request $request)
    {
        //
        $fromDate = $request->query('fromDate');
        $toDate = $request->query('toDate');

            if($fromDate != '' && $toDate != '')
            {
                $data = Item::whereBetween('created_at', array($fromDate, $toDate))
                    ->get();
            }
            else
            {
                $data = Item::table('created_at')->orderBy('created_at', 'desc')->get();
            }
        
        $title = "Laporan";
        $pdf = PDF::loadView('pdf.laporan_item', compact('title', 'data'));
        return $pdf->download("laporan_item_{{$fromDate}}_{{$toDate}}.pdf");
    }

    public function create()
    {
        $title = "Halaman Tambah Barang";
        return view('item.create', compact('title'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->validated();
        $data['photo']->move(public_path('assets/images/item'), $data['photo']->getClientOriginalName());
        $data['photo'] = $data['photo']->getClientOriginalName();

        $status = Item::create($data);

        if($status){
            session()->flash('success', 'Sukses Menambahkan Item');
        } else {
            session()->flash('failed', 'Gagal Menambahkan Item');
        }

        return redirect('item');
    }

    public function show(Item $item)
    {
        //
    }

    public function edit($id)
    {
        $title = "Halaman Edit Barang";
        $item = Item::findOrFail($id);

        return view('item.edit', compact('title', 'item'));
    }

    public function update(ItemRequest $request, $id)
    {
        $data = $request->validated();

        if(isset($data['photo'])){
            $data['photo']->move(public_path('assets/images/item'), $data['photo']->getClientOriginalName());
            $data['photo'] = $data['photo']->getClientOriginalName();
        }

            $status = Item::where('id', $id)->update($data);

        if($status){
            session()->flash('success', 'Sukses Mengupdate Item');
        } else {
            session()->flash('failed', 'Gagal Mengupdate Item');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $status = Item::findOrFail($id)->delete();

        if($status){
            session()->flash('success', 'Sukses Menghapus Item');
        } else {
            session()->flash('failed', 'Gagal Menghapus Item');
        }

        return redirect()->back();
    }
}
