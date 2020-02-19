@extends('layouts.admin')

@section('judul-card')

<h2>Images</h2>

@endsection

@section('konten-admin')
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>ID</th>
                <th>File</th>
                <th>Created Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    {{-- <td>{{$photo->file}}</td> --}}
                    <td><img height="50" src="{{$photo->file}}" alt=""></td>
                    <td>{{$photo->created_at->diffForHumans()}}</td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['AdminMediaController@destroy',$photo->id]]) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-sm float-right']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

@endsection
