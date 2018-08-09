<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ListController extends Controller
{
    public function index()
    {
        $items = Item::all();
    	return view('list', compact('items'));
    }

    public function create(Request $request)
    {
        $item = new item;
        $item->item = $request->text;
        $item->save();
    	return redirect('list');
    }

    public function delete(Request $request)
    {
        Item::where('id', $request->id)->delete();
        return $request->all();
    }
}
