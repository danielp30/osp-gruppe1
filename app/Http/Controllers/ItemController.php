<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Informationsstand;
use App\Models\Lecture;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // Determine if the "all" parameter is present and true
        $loadAllItems = $request->query('all') === 'true';
    
        // Get the logged-in user
        $user = $request->user();
    
        // Query items based on the parameter
        $items = [];
    
        if ($loadAllItems) {
            $items['information_stands'] = Informationsstand::with('user')->get();
            $items['lectures'] = Lecture::with('user')->get();
        } else {
            $items['information_stands'] = Informationsstand::with('user')->where('user_id', $user->id)->get();
            $items['lectures'] = Lecture::with('user')->where('user_id', $user->id)->get();
        }
    
        return response()->json($items);
    }
    
}
