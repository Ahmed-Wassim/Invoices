<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    public function index()
    {
        return view('reports.InvoiceReport');
    }

    public function search(Request $request)
    {
        $radio = $request->rdio;
        if ($radio == 1) {
            if ($request->type && $request->start_at == '' && $request->end_at == '') {
                $invoices = invoices::select('*')->where('Status', $request->type)->get();
                $type = $request->type;
                return view('reports.InvoiceReport', compact('type', 'invoices'));
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = invoices::whereBetween('invoice_Date', [$start_at, $end_at])->where('Status', '=', $request->type)->get();
                return view('reports.InvoiceReport', compact('type', 'start_at', 'end_at', 'invoices'));
            }
        } else {
            $invoices = invoices::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('reports.InvoiceReport', compact('invoices'));
        }
    }
}
