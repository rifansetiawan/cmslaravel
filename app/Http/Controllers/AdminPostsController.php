<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequests;
use App\Photo;
use App\Post;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class AdminPostsController extends Controller
{

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(3);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequests $request)
    {
        //
        $input = $request -> all();

        $user = Auth::user();


        if ($file = $request->file('photo_id')) {
            $name = $file -> getClientOriginalName();
            $file->move('images', $name);

            $cucok = Photo::create(['file'=>$name]);
            // $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $cucok->id;
        }
        // $input['category_id'] = 354;
        $user->posts()->create($input);

        return redirect('/admin/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $post = Post::findOrFail($id);
        $input = $request->all();


        if($file = $request->file('photo_id')){
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        Auth::user() -> posts() -> whereId($id)->first()->update($input);

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        if ($post->photo) {
            unlink(public_path() . $post->photo->file);
        }
        $post->delete();
        return redirect('admin/posts');
    }

    public function post($slug){

        $post = Post::where('slug','=',$slug)->firstOrFail();
        $comments = $post->comments()->whereIsActive(1)->get();


        return view('post', compact('post','comments'));
    }
}
