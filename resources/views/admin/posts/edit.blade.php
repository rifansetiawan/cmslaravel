@extends('layouts.admin')

@section('judul-card')
    <h2>Edit Posts</h2>
@endsection

@section('konten-admin')



    <div class="row">

    <div class="col-sm-4">
        <img src="{{$post->photo->file}}" alt="">
    </div>

    {!! Form::model($post,['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id], 'files'=>true]) !!}

    <div class='form-group'>
    {!! Form::label('title','Title : ') !!}
    {!! Form::text('title',null, ['class' => 'form-control']) !!}
    </div>

    <div class='form-group'>
    {!! Form::label('category_id','Category : ') !!}
    {!! Form::select('category_id',array(0=>'Choose Category')+$categories,null,  ['class'=>'form-control']) !!}
    </div>

    <div class='form-group'>
    {!! Form::label('photo_id','Photo : ') !!}
    {!! Form::file('photo_id',null, ['class'=>'form-control']) !!}
    </div>

    <div class='form-group'>
    {!! Form::label('body','Content : ') !!}
    {!! Form::textarea('body',null, ['class' => 'form-control', 'rows'=>3]) !!}
    </div>

    <div class="row float-right">
        <div class='form-group'>
            {!! Form::submit('Update Post', ['class'=>'btn btn-primary']) !!}
        </div>
            {!! Form::close() !!}

        &nbsp;
        &nbsp;
        {!! Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]]) !!}
        <div class='form-group'>
        {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

    </div>


    </div>




    {{-- <div class="row"> --}}
        @include('includes/error_form')
    {{-- </div> --}}
@endsection
