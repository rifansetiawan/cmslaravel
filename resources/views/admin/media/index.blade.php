@extends('layouts.admin')

@section('judul-card')

<h2>Images</h2>

@endsection

@section('konten-admin')

    <form action="/delete/selected" method="post" class="form-inline">

        {{csrf_field()}}
        {{method_field('delete')}}

        <div class="form-group">
            <select name="checkBoxArray" id="" class="form-control">
                <option value="">Delete</option>

            </select>
        </div>
        &nbsp;
        <div class="form-group">
            <input type="submit" name="delete_all" class="form-control btn btn-primary">
        </div>

        <table class='table table-hover'>
            <thead>
                <tr>
                    <th><input type="checkbox" id="options"></th>
                    <th>ID</th>
                    <th>File</th>
                    <th>Created Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($photos as $photo)
                    <tr>
                    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]"  value="{{$photo->id}}"></td>
                        <td>{{$photo->id}}</td>
                        {{-- <td>{{$photo->file}}</td> --}}
                        <td><img height="50" src="{{$photo->file}}" alt=""></td>
                        <td>{{$photo->created_at->diffForHumans()}}</td>
                        <td>

                            <input type="hidden" name="photo" value="{{$photo->id}}">

                            <div class="form-group">
                                <input type="submit" name="delete_single" value="delete" class="btn btn-danger">
                            </div>
                            {{-- {!! Form::open(['method'=>'DELETE','action'=>['AdminMediaController@destroy',$photo->id]]) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-sm float-right']) !!}
                            {!! Form::close() !!} --}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </form>



@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            $('#popoverData').popover();
            $('#popoverOption').popover({ trigger: "hover" });
            console.log('tai');

            $('#options').click(function(){

                if(this.checked){
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                    });
                }
                else{
                    $('.checkBoxes').each(function(){
                        this.checked = false;
                    });
                }


                // console.log('it works')
            });
        });
    </script>

@endsection
