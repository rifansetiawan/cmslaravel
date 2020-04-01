@extends('layouts/blog-post')

@section('content')
<div class="col-lg-8">

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
<p class="lead"> {!!   $post->body !!}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    @if (Auth::check())

        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}
                <div type="hidden" class='form-group'>
                    {!! Form::hidden('post_id', $post->id ) !!}
                </div>
                <div type="hidden" >
                    {!! Form::hidden('is_active', 0) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('body','Body : ') !!}
                    {!! Form::textarea('body',null, ['class' => 'form-control', 'rows'=>3] ) !!}
                </div>
                <div class='form-group'>
                    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>

    @endif


    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @if (count($comments) > 0)



        @foreach ($comments as $comment)
            @if ($comment->is_active == 1)
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    {{$comment->body}}
                    @foreach ($comment->replies as $reply)
                        @if (count($comment->replies) > 0 and $reply->is_active == 1)

                        <div class="media">
                            <a class="pull-left" href="#">
                                <img height="64" class="media-object" src="{{$reply->photo}}" alt="" width="64">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>
                            <br>
                        </div>
                        @endif
                    @endforeach
                    @if (Auth::check())
                        {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}

                        {!! Form::hidden('comment_id', $comment->id ) !!}
                        <input type="hidden" name="is_active" value="0">
                        <div class='form-group'>
                            {!! Form::label('body','Body : ') !!}
                            {!! Form::text('body',null, ['class' => 'form-control','rows'=>3]) !!}
                        </div>
                        <div class='form-group'>
                            {!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}

                    @endif



                </div>
            </div>

            @endif

        @endforeach

    @endif




</div>


@endsection
