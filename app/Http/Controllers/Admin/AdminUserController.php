<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use App\User;
use App\Client;
use Validator;
use Hash;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;


class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->params = array(
            'menu' => 'users'
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->except(Auth::id());
        $this->params['users'] = $users;
        return view('user.index')->with($this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->params['action'] = 'create';
        return view('user.form')->with($this->params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        
        // retrieve validated data
        $data = $request->validated();
        // add new data to array
        $data  += ['is_admin' => '0'];
        // store data to user
        $user  = User::create($data);
        // get the id of created user and apply as user_id
        $data  += ['user_id' => $user->id];
        // store data  to client
        $client = Client::create($data);

        return redirect('admin/users')->with('success', 'New User Successfully Added');

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
        $this->params['user'] = User::find($id);
        $this->params['action'] = 'update';
        return view('user.form')->with($this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserFormRequest $request)
    {
        
        DB::beginTransaction();
        try {
            User::find($user->id)->update($request->validated());
            $client = Client::where('user_id', $user->id); 
            $client->update($request->only('first_name', 'last_name','address','contact_number'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back()->with('success', 'Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $client = Client::where('user_id', $id);

        $client->delete();
        $user->delete();

        return redirect()->back()->withSuccess('Client Successfully Deleted!');
    }


    public function account()
    {
        $this->params['action'] = 'adminAccount';
        $this->params['menu'] = 'account';
        $this->params['user'] = Auth::user();
        // return $this->params;
        return view('user.form')->with($this->params);
    }

    public function update_admin(Request $request)
    {
        $admin = Auth::user();
        $rules = array(
            'email'        => 'required|string|email|max:255|unique:users,email,'.$admin->id,  
        );

        if ($request->filled(['password'])) {
            $rules += [
                'password' => 'required|min:8|confirmed',
            ];
        }

        $validator = Validator::make( $request->all(), $rules );
        if ( $validator->fails() ) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin->email        = $request->email;

        if ($request->filled('password')) {
            $admin->password   =  $request->password;
        }
        $admin->save();

        return redirect()->back()->with('success', 'Updated Successfully');
        
    }

    public function dashboard()
    {
        // display dashboard
        $this->params['menu'] = 'dashboard';

        return view('dashboard')->with($this->params);
    }


}
