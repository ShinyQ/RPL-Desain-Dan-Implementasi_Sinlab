<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\TransactionRequest;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Transaction::latest()->paginate(4);
        $title = "Halaman Transaction";
        return view('transaction.index', compact('title', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Ajukan Peminjaman";
        return view('transaction.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $title = "Peminjaman";
        return view('transaction.show', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionRequest $requestTransaction)
    {
        //
        Response()->json($requestTransaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionRequest $requestTransaction)
    {
        if ($requestTransaction->status == "Menunggu Persetujuan") {
            $requestTransaction->feedback = $request->feedback;
        }

        $requestTransaction->status = $request->status;
        $requestTransaction->save();

        return Response()->json([
            'message' => 'OK',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
