@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>My chat ID: {{ $user->chat_id }}</b></div>

                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date added</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $task->id }}</th>
                            <td>{{ $task->task }}</td>
                            <td>
                                @if ($task->completed == 1)
                                    Completed
                                @else
                                    Not completed
                                @endif
                            </td>
                            <td>{{ $task->created_at }}</td>
                            <td>
                                @if ($task->completed == 0)
                                    <a href="/dashboard/{{ $task->id }}/finish"><button class="btn-xs btn-success">Mark completed</button></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        
                        @if (count($tasks) === 0)
                            <tr>
                                <td colspan="5">You don't have any tasks!</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
