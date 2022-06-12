<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\TransactionRequest;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function export_pdf(Request $request)
    {

        $fromDate = $request->query('fromDate');
        $toDate = $request->query('toDate');

            if($fromDate != '' && $toDate != '')
            {
                $data = Transaction::whereBetween('created_at', array($fromDate, $toDate))->get();
            }
            else
            {
                $data = Transaction::table('created_at')->orderBy('created_at', 'desc')->get();
            }

        $title = "Laporan";
        $pdf = PDF::loadView('pdf.laporan_transaksi', compact('title', 'data'));
        return $pdf->download("laporan_transaksi_{{$fromDate}}_{{$toDate}}.pdf");
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
    public function update(Request $request, TransactionRequest $requestTransaction,Transaction $transaction)
    {
        if ($transaction->status == "Menunggu Persetujuan") {
            $transaction->feedback = $request->feedback;
        }

        $transaction->status = $request->status;
        $transaction->save();

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
