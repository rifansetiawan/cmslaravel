@extends('layouts.admin')

@section('stylecss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">

@endsection
@section('judul-card')

<h2>Upload Images</h2>

@endsection

@section('konten-admin')

    {!! Form::open(['method'=>'POST','action'=>'AdminMediaController@store', 'class'=>'dropzone']) !!}
    {!! Form::close() !!}

@endsection


@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
@endsection
