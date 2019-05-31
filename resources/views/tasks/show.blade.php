@extends('layouts.app')

@section('content')

<h1>id = {{ $task->id }} の詳細</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th>タスク詳細</th>
            <td>{{ $task->content }}</td>
        </tr>
    </table>
    
     {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $task->id], ['class' => 'btn btn-success']) !!}

@endsection