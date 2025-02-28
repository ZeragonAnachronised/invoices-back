<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\User;

class InvoiceController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'executorId' => 'required',
            'period' => 'required',
            'description' => 'required|string|max:512|min:32'
        ]);

        $invoice = Auth::user()->invoices()->create([
            'customer' => Auth::user()->username(),
            'executorId' => $request->customerId,
            'executor' => User::where('id', $request->executorId)->first()->username,
            'period' => $request->period,
            'description' => $request->description
        ]);

        return response()->json([
            'invoice' => $invoice
        ], 201);
    }
}
