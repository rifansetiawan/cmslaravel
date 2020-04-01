@extends('layouts.admin')

@section('judul-card')
    <h2>Comments</h2>
@endsection

@section('konten-admin')

    @if (count($comments) > 0)
    <table class='table table-hover'>
        {{-- @if (count($comments) > 0) --}}
        <thead>
            <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Created at</th>
            <th>Status</th>
            </tr>
        </thead>
        <tbody>

                @foreach ($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$comment->body}}</td>
                        <td>{{$comment->created_at->diffForHumans()}}</td>
                        <td>{{$comment->is_active}}</td>
                        <td><a href="{{ route('home.post', $comment->post->id) }}">View Post</a></td>
                        <td>
                            {!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}

                            @if ($comment->is_active == 0)
                                {!! Form::hidden('is_active', 1) !!}
                                <div class='form-group'>
                                {!! Form::submit('Approve', ['class'=>'btn btn-primary']) !!}
                                </div>
                            @else
                                {!! Form::hidden('is_active', 0) !!}
                                <div class='form-group'>
                                {!! Form::submit('Approved', ['class'=>'btn btn-secondary']) !!}
                                </div>

                            @endif

                            {!! Form::close() !!}
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE','action'=>['PostCommentsController@destroy',$comment->id]]) !!}
                            <div class='form-group'>
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach

        </tbody>
        {{-- @else --}}
        {{-- <h1>There is no comment here</h1> --}}
        {{-- @endif --}}
    </table>

    @else
    <h2>There is no Comment of this post</h2>

    @endif



@endsection
