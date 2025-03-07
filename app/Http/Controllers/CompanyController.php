<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255'
        ]);

        $company = Auth::user()->companies()->create([
            'name' => $request->name,
            'owner' => Auth::user()->name,
            'email' => $request->email
        ]);
        $company->save();

        return response()->json([
            'company' => $company
        ], 201);
    }
    public function index($company_id)
    {
        if(Invoice::where('id', $company_id)->count())
        {
            $company = Invoice::where('id', $company_id)->first()->get();
            return request()->json([
                'company' => $company
            ], 200);
        }
        else {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }
    }
    
}
