<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:staff');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $querystring = ['type' => $request->get('type')];

        if( $request->has('q') ){
            $querystring['q'] = $request->get('q');
        }

        $users = Role::where('name', $request->get('type'))
                    ->first()
                    ->users()
                    ->where(function($query) use ($request){
                        $query->where('firstname', 'LIKE', '%' . $request->get('q') . '%')                        
                                ->orWhere('lastname', 'LIKE', '%' . $request->get('q') . '%')                      
                                ->orWhere('email', 'LIKE', '%' . $request->get('q') . '%');
                    })
                    ->paginate(7);

        return view('users.index', compact('users', 'querystring'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = Role::where('name', $request->get('type'))
                    ->first()
                    ->users()
                    ->paginate(7);
        return view('users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request, $id)
    {
        /* List of 7 latest users */
        $users = Role::where('name', 'staff')
                    ->first()
                    ->users()
                    ->paginate(7);

        /* Selected User */
        $user = User::findOrFail($id);
        return view('users.edit', compact('users', 'user'));
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
    }
}
