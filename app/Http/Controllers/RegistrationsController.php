<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationsController extends Controller
{
    public function index(Request $request)
    {
        $items = [];

        $items = Registration::all();

        return response()->json($items);
    }
}
