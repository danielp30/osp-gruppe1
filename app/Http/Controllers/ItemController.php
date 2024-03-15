<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Informationsstand;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $informationStand = new Informationsstand();
        $informationStand->name = $request->name;
        $informationStand->description = $request->description;
        $informationStand->user_id = $user->id;
        $informationStand->save();

        $lecture = new Lecture();
        $lecture->title = $request->title;
        $lecture->user_id = $user->id;
        $lecture->save();

        return response()->json(['message' => 'Items created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        $informationStand = Informationsstand::where('id', $id)->where('user_id', $user->id)->first();
        if ($informationStand) {
            $informationStand->name = $request->name;
            $informationStand->description = $request->description;
            $informationStand->save();
        }

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

        $informationStand = Informationsstand::where('id', $id)->where('user_id', $user->id)->first();
        if ($informationStand) {
            $informationStand->delete();
        }

        $lecture = Lecture::where('id', $id)->where('user_id', $user->id)->first();
        if ($lecture) {
            $lecture->delete();
        }

        return response()->json(['message' => 'Item deleted successfully'], 200);
    }

    public function approve(Request $request, $id)
    {
        $item = Informationsstand::find($id);

        if (!$item) {
            $item = Lecture::find($id);
        }

        if ($item) {
            $item->status = 'genehmigt';
            $item->save();

            return response()->json(['message' => 'Item approved successfully'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function reject(Request $request, $id)
    {
        $item = Informationsstand::find($id);
        if (!$item) {
            $item = Lecture::find($id);
        }

        if ($item) {
            $item->status = 'abgelehnt';
            $item->save();

            return response()->json(['message' => 'Item rejected successfully'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function delete(Request $request, $id)
    {
        $item = Informationsstand::find($id);

        if (!$item) {
            $item = Lecture::find($id);
        }

        if ($item) {
            $item->delete();

            return response()->json(['message' => 'Item deleted successfully'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function cancel(Request $request, $id)
    {
        $item = Informationsstand::find($id);

        if (!$item) {
            $item = Lecture::find($id);
        }

        if ($item) {
            $item->status = 'storniert';
            $item->save();

            return response()->json(['message' => 'Item rejected successfully'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function newstore(Request $request)
    {
        $user = request()->user();

        $informationStand = new Informationsstand();
        $informationStand->user_id = $user->id;
        $informationStand->date = $request->date;
        $informationStand->status = 'offen';
        $informationStand->created_at = date('now');
        $informationStand->message = $request->message;

        $informationStand->save();

        if ($request->vortrag === 'ja') {
            $lecture = new Lecture();
            $lecture->title = $request->title;
            $lecture->date = $request->date;
            $lecture->status = $request->status;
            $lecture->subject = $request->subject;
            $lecture->user_id = $request->user()->id;
            $lecture->save();
        }

        // Return a success response
        return response()->json(['message' => 'Items created successfully'], 201);
    }



}
