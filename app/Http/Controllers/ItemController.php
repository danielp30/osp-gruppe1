<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Informationsstand;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $user = $request->user();
        // Beispiel für die Erstellung eines Informationsstands
        $informationStand = new Informationsstand();
        $informationStand->name = $request->name;
        $informationStand->description = $request->description;
        $informationStand->user_id = $user->id;
        $informationStand->save();

        // Beispiel für die Erstellung einer Vorlesung
        $lecture = new Lecture();
        $lecture->title = $request->title;
        $lecture->user_id = $user->id;
        $lecture->save();

        return response()->json(['message' => 'Items created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        // Beispiel für die Aktualisierung eines Informationsstands
        $informationStand = Informationsstand::where('id', $id)->where('user_id', $user->id)->first();
        if ($informationStand) {
            $informationStand->name = $request->name;
            $informationStand->description = $request->description;
            $informationStand->save();
        }

        // Beispiel für die Aktualisierung einer Vorlesung
        $lecture = Lecture::where('id', $id)->where('user_id', $user->id)->first();
        if ($lecture) {
            $lecture->title = $request->title;
            $lecture->save();
        }

        return response()->json(['message' => 'Item updated successfully'], 200);
    }

    public function destroy($id)
    {
        $user = request()->user();
        // Beispiel für das Löschen eines Informationsstands
        $informationStand = Informationsstand::where('id', $id)->where('user_id', $user->id)->first();
        if ($informationStand) {
            $informationStand->delete();
        }

        // Beispiel für das Löschen einer Vorlesung
        $lecture = Lecture::where('id', $id)->where('user_id', $user->id)->first();
        if ($lecture) {
            $lecture->delete();
        }

        return response()->json(['message' => 'Item deleted successfully'], 200);
    }

    public function approve(Request $request, $id)
    {
        $user = Auth::user();

        $item = Informationsstand::find($id);

        if (!$item) {
            $item = Lecture::find($id);
        }

        if ($item) {
            $item->status = $item instanceof Informationsstand ? 'genehmigen' : 'abgeschlossen';
            $item->save();

            return response()->json(['message' => 'Item approved successfully'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function reject(Request $request, $id)
    {
        $user = Auth::user();

        // Find the item by ID
        $item = Informationsstand::find($id);
        if (!$item) {
            $item = Lecture::find($id);
        }

        // Check if the user owns the item
        if ($item) {
            // Update the status to "ablehnen" or "inaktiv" depending on the type
            $item->status = $item instanceof Informationsstand ? 'ablehnen' : 'inaktiv';
            $item->save();

            return response()->json(['message' => 'Item rejected successfully'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

}
