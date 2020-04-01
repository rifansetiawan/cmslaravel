@extends('layouts.admin')

@section('judul-card')

    <h2>Comment</h2>
@endsection

@section('konten-admin')

    @if (count($replies) > 0 )
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Author</th>
                <th>Photo</th>
                <th>Email</th>
                <th>Body</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($replies as $reply)
            <tr>
               
                <td>{{$reply->author}}</td>
                <td><img height="64" src="{{$reply->photo}}" alt=""></td>
                <td>{{$reply->email}}</td>
                <td>{{$reply->body}}</td>
                <td>{{$reply->created_at->diffForHumans()}}</td>
                <td>{{$reply->id}}</td>
                <td>
                    @if($reply->is_active == 0)
                        {!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}
                        <div class='form-group'>
                        {!! Form::hidden('is_active',1) !!}
                        {!! Form::submit('Approve', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}
                        <div class='form-group'>
                        {!! Form::hidden('is_active',0) !!}
                        {!! Form::submit('Approved', ['class'=>'btn btn-secondary']) !!}
                        </div>
                        {!! Form::close() !!}
                    @endif

                </td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}
                    <div class='form-group'>
                    {!! Form::submit('DELETE', ['class'=>'btn btn-danger']) !!}
                    </div>
                    {!! Form::close() !!}

                </td>

            </tr>
            @endforeach


        </tbody>
    </table>
    @else
        <h2>The is no replies of this comment</h2>

    @endif


@endsection
