<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ListItem;

class TodoListController extends Controller
{

    public function index()
    {
        $listItems = ListItem::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('todolist.todo', compact('listItems'));
    }

    public function markDone($id)
    {
        $listItem = ListItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $listItem->delete();

        return redirect('/todo');
    }


    public function saveItem(Request $request)
    {
        $request->validate([
            'listItem' => 'required',
        ]);
        $newListItem = new ListItem;
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 0;
        $newListItem->user_id = $request->user()->id;
        $newListItem->save();

        return redirect('/todo');
    }
}
