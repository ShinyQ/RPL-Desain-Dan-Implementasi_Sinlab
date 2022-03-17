<?php

namespace App\Http\Controllers;

use App\Models\RequestItem;
use Illuminate\Http\Request;

class RequestItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = RequestItem::latest()->paginate(5);
        $title = "Halaman Request Item";
        return view('request.index', compact('title', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Halaman Create Request Item";
        return view('item.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestItem  $requestItem
     * @return \Illuminate\Http\Response
     */
    public function show(RequestItem $requestItem)
    {
        return Response()->json($requestItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestItem  $requestItem
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestItem $requestItem)
    {
        return Response()->json($requestItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestItem  $requestItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestItem $requestItem)
    {
        if ($requestItem->status == "Menunggu Persetujuan") {
            $requestItem->feedback = $request->feedback;
        }

        $requestItem->status = $request->status;
        $requestItem->save();

        return Response()->json([
            'message' => 'OK',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestItem  $requestItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestItem $requestItem)
    {
        //
    }
}
