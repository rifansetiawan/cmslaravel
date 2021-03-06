@extends('layouts.admin')

@section('judul-card')
    <h2>Posts</h2>
@endsection


@section('konten-admin')

    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Post ID</th>
                <th>User</th>
                <th>Category</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @if ($posts)
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->user->name}}</td>

                    @if ($post->category)
                    <td>{{$post->category->name}}</td>
                    @else
                    <td>Uncategorized</td>
                    @endif

                    @if ($post->photo)
                    {{-- <td>{{$post->photo_id}}</td> --}}
                    <td><img height="50" src="{{$post->photo->file}}" alt=""></td>
                    @else
                    <td><img height="50" src="{{'http://placehold.it/400x400'}}" alt=""></td>
                    @endif

                    <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{$post->title}}</a></td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td><a href="{{ route('home.post', $post->slug) }}">View Post</a></td>
                    {{-- <td><a href="{{ route('admin.comments.index') }}">View All Comment</a></td> --}}
                    <td><a href="{{ route('admin.replies.show', $post->id) }}">View Comments of This Post</a></td>
                </tr>

                @endforeach

            @endif

        </tbody>
    </table>

    <div class="row justify-content-center">
        <div class="col-sm-2 col-sm-offset-2">
            {{$posts->render()}}
        </div>
    </div>

@endsection
