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
            'customerId' => 'required',
            'period' => 'required',
            'description' => 'required|string|max:512|min:32'
        ]);

        Auth::user()->invoices()->create([
            'executor' => Auth::user()->username(),
            'customerId' => $request->customerId,
            'customer' => User::where('id', $request->customerId)->first()->username,
            'period' => $request->period,
            'description' => $request->description
        ]);

        return response()->json([
            'user' => $user
        ], 201);
    }
}
