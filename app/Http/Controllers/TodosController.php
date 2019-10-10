<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller
{
    public function index()

    {
        return view('todos.index')->with('todos', Todo::all()); //todos.indexへ'todos'という名前でTodoテーブルの全ての情報を渡す
    }

    public function show($todoId)

    {
        return view('todos.show')->with('todo', Todo::find($todoId));
    }

    public function create()

    {
        return view('todos.create');
    }

    public function post()

    {
        // dd(request()->all());
        $data = request()->all();
        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;

        $todo->save();

        return redirect('/todos');

    }
}
