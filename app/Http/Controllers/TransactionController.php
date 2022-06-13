<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Http\Requests\TransactionRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $items = [];
        if ($user->role != "super_user"){
            $items =  Transaction::where('id', $user->id)->paginate(5);
        }else{
            $items = Transaction::latest()->paginate(5);
        }
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
    public function create(Request $request)
    {
        $items = [];
        $queryParams = '';
        if ($request->query('items')){
            $items = Item::whereIn('id', $request->query('items'))->get();
        }

        $title = "Ajukan Peminjaman";
        return view('transaction.create', compact('title','items'));
    }

    /**$
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'start_date'=> $request->startDate,
            'deadline'=> $request->deadline,
            'reason'=> $request->reason,
        ]);
        foreach ($request->ids as $key => $id ) {
            TransactionItem::create([
                'transaction_id'=>$transaction->id,
                'item_id'=> $id,
                'qty' => $request->qty[$key],
            ]);
        }
        session()->flash('success', 'Sukses Mengajukan Pinjaman');
        return redirect('item');
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
        $items = Item::where('id', $transaction->id)->get();
        return view('transaction.show', compact('title','transaction', 'items'));
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
