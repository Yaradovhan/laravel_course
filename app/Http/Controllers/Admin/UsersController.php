<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = User::create([
           'email'=>$request['email'],
           'name'=>$request['name'],
            'status'=>User::STATUS_ACTIVE
        ]);

        return redirect()->route('admin.users.show', ['id'=>$user->id]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
