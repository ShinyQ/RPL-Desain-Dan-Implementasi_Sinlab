<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $title = "Halaman Barang Inventaris";
        $items = Item::get();

        return view('item.index', compact('items', 'title'));
    }

    public function create()
    {
        $title = "Halaman Tambah Barang";
        return view('item.create', compact('title'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->validated();
        $data['photo']?->move(public_path('images'), $data['photo']->getClientOriginalName());

        Item::create($data);
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
