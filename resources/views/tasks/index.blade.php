<h1>タスクリスト</h1>

@if (count($tasks) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>ステータス</th>
                <th>内容</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)　{{-- Auth::user()->tasks で持ってきた連想配列の繰り返し--}}
            <tr>
                <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->content }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

{{ $tasks->render('pagination::bootstrap-4') }}
{!! link_to_route('tasks.create', '新規タスクの作成', null, ['class' => 'btn btn-success']) !!}
