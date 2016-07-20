<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\User;

use Carbon\Carbon;
use Session;

class UserController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "admin";
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //if (Auth::check())
        {
            $users = User::paginate(15);

            return view('admin.user.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'password' => 'required', ]);

		$hashedpassword = \Hash::make($request->password);
		
		$request->merge([ 'password' => $hashedpassword ]);
		
        User::create($request->all());

        Session::flash('flash_message', 'User added!');

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $User = User::findOrFail($id);

        return view('admin.user.show', compact('User'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $User = User::findOrFail($id);

        return view('admin.user.edit', compact('User'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'password' => 'required', ]);

        $User = User::findOrFail($id);

        $hashedpassword = \Hash::make($request->password);
        
        $request->merge([ 'password' => $hashedpassword ]);
        
        $User->update($request->all());

        Session::flash('flash_message', 'User updated!');

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('flash_message', 'user deleted!');

        return redirect('admin/users');
    }
	
}
