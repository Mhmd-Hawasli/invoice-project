<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Invoices\StoreInvoiceRequest;
use App\Models\InvoiceDetail;
use App\Models\invoices_detailes;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('pages.invoices.all-invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('pages.invoices.add-invoices', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validatedData = $request->validated();

        // Check if the request has a file
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
        } else {
            $filePath = null;
        }
        DB::beginTransaction();
        try {
            $invoice = Invoice::create([
                'invoice_number'     => $validatedData['invoice-number'],
                'invoice_date'       => $validatedData['invoice-date'],
                'due_date'           => $validatedData['due-date'],
                'user_id'            => Auth::id(),
                'section_id'         => $validatedData['section'],
                'product_id'         => $validatedData['product'],
                'collected_amount'   => $validatedData['collected-amount'],
                'commission_amount'  => $validatedData['commission-amount'],
                'discount'           => $validatedData['discount'],
                'rate_vat'           => $validatedData['rate-vat'],
                'value_vat'          => $validatedData['value-vat'],
                'total'              => $validatedData['total'],
                'note'               => $validatedData['note'],
                'status'             => 0,
                'attachment'         => $filePath,
            ]);

            InvoiceDetail::create([
                'invoice_id' => $invoice->id,
                'user_id'    => Auth::id(),
                'note'       => "إضافة فاتورة جديدة.",
                'status'     => 0,
            ]);

            DB::commit();
            return redirect('/invoices')->with('success', 'تم إضافة الفاتورة بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'لم تتم إضافة الفاتورة بنجاح.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
