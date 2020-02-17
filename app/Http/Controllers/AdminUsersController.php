<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequests;
use App\Http\Requests\UsersCreateRequests;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;
use DB;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateRequests $request)
    {
        //
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


       if($file = $request -> file('photos_id')){
            $name = $file -> getClientOriginalName();
            $file -> move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photos_id'] = $photo->id;
       }
        User::create($input);
        Session::flash('created_user','The user has been created');
        return redirect('admin/users');
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
        $user = User::findOrFail($id);
        $role = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequests $request, $id)
    {
        //

        $user = User::findOrFail($id);

        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        if($file = $request->file('photos_id')){
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photos_id'] = $photo->id;
        }
        $user -> update ($input);

        Session::flash('updated_user','The user has been updated');

        return redirect('admin/users');
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
        $user = User::findOrFail($id);
        unlink(public_path() . $user->photo->file);

        $user->delete();

        Session::flash('deleted_user','The user has been deleted');
        return redirect('/admin/users');
    }
}
