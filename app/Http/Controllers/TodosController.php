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
}
