<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Todo::where('user_id', auth()->id());

        if ($request->filled('status') && in_array($request->status, ['proses', 'selesai'])) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('title', 'like', "%{$q}%");
        }

        $todos = $query->latest()->get();

        return view('todos.index', [
            'todos'  => $todos,
            'status' => $request->get('status', 'all'),
            'q'      => $request->get('q', ''),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        Todo::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'status'  => 'proses',
        ]);

        return redirect()->route('todos.index');
    }

    public function update(Request $request, Todo $todo)
    {
        abort_if($todo->user_id !== auth()->id(), 403);
        
        if ($todo->status === 'selesai') {
            return back()->with('locked', 'Item yang sudah selesai tidak bisa diedit.');
        }

        $data = $request->validate([
            'title'  => 'required|string|max:255',
            'status' => 'required|in:proses,selesai',
        ]);

        $todo->update($data);

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        abort_if($todo->user_id !== auth()->id(), 403);
        $todo->delete();
        return redirect()->route('todos.index');
    }
}
