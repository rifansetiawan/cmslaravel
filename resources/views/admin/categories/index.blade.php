@extends('layouts.admin')


@section('judul-card')
    <h3>Categories</h3>
@endsection

@section('konten-admin')
    <div class="row">
        <div class="col-sm-4">

            {!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}
                <div class='form-group'>
                    {!! Form::label('name','Category : ') !!}
                    {!! Form::text('name',null, ['class' => 'form-control']) !!}
                </div>
                <div class='form-group float-right'>
                    {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
        <div class="col-sm-8">
            <table class='table table-hover'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                        @if ($categories)

                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->created_at ? $category -> created_at ->diffForHumans() : "No Time"}}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach

                        @endif


                </tbody>
            </table>

        </div>

    </div>

@endsection
