@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Tasklistにようこそ！</h1>
            {!! link_to_route('signup.get', '新規ユーザー登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endsection