@extends('layouts.app')

@section('title')
  Todos List
@endsection

@section('content')

  <h1 class="text-center my-5">
    Todos
  </h1>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">
        Todos
        </div>
        <div class="card-body">
          <ul class="list-group">
            @foreach($todos as $todo)
              <li class="list-group-item">
                {{ $todo->name }}
                @if ($todo->completed == false)
                  <form action="/todos/{{ $todo->id }}/complete-todos" method="POST" class="float-right">
                  @csrf
                    <input type="hidden" class="form-control" name="completed", value=1>
                    <button type="submit" class="btn btn-primary btn-sm float-right">Complete Todo</button>
                  </form>
                @endif
                <a href="/todos/{{ $todo->id }}" class="btn btn-secondary btn-sm float-right mx-2">View</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

@endsection