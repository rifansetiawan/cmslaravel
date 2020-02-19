@extends('layouts.admin')

@section('judul-card')
    <h2>Create Posts</h2>
@endsection

@section('konten-admin')


    {!! Form::open(['method'=>'POST','action'=>'AdminPostsController@store', 'files'=>true]) !!}

    <div class='form-group'>
    {!! Form::label('title','Title : ') !!}
    {!! Form::text('title',null, ['class' => 'form-control']) !!}
    </div>

    <div class='form-group'>
    {!! Form::label('category_id','Category : ') !!}
    {!! Form::select('category_id',array(''=>'Choose Category')+$categories,null,  ['class'=>'form-control']) !!}
    </div>

    <div class='form-group'>
    {!! Form::label('photo_id','Photo : ') !!}
    <br>
    {!! Form::file('photo_id',null, ['class'=>'form-control']) !!}
    </div>

    <div class='form-group'>
    {!! Form::label('body','Content : ') !!}
    {!! Form::textarea('body',null, ['class' => 'form-control', 'rows'=>3]) !!}
    </div>

    <div class='form-group'>
    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}


    {{-- <div class="row"> --}}
        @include('includes/error_form')
    {{-- </div> --}}
@endsection
