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

    public function show(Todo $todo) //Todoモデルからtodosテーブルのid:todo(ルーティングで持ってきたtodo)のレコードを$todoへ代入

    {
        return view('todos.show')->with('todo', $todo);
    }

    public function new()

    {
        return view('todos.new');
    }

    public function create()

    {
        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required'
        ]);

        // dd(request()->all());
        $data = request()->all();
        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;

        $todo->save();

        session()->flash('success', 'Todo created successfully.');

        return redirect('/todos');

    }

    public function edit(Todo $todo)

    {
        return view('todos.edit')->with('todo', $todo);
    }

    public function update($todoId)

    {
        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required'
        ]);

        $data = request()->all(); //フォームからRequestオブジェクト（データ）を取得

        $todo = Todo::find($todoId);
        $todo->name = $data['name'];
        $todo->description = $data['description'];

        $todo->save();

        session()->flash('success', 'Todo updated successfully.');


        return redirect('/todos');
    }

    public function destroy(Todo $todo)

    {
        $todo->delete();
        session()->flash('success', 'Todo deleted successfully.');
        return redirect('/todos');
    }

    public function complete($todoId)

    {
        $data = request()->all(); //フォームからRequestオブジェクト（データ）を取得

        $todo = Todo::find($todoId);
        $todo->completed = $data['completed'];

        $todo->save();

        session()->flash('success', 'Todo completed successfully.');

        return redirect('/todos');
    }
}
