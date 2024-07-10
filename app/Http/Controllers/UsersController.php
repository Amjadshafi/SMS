<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Organization;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $user = auth()->user();
        
        
        if ($user->hasRole('Super Admin')) {
            $users = User::with('organization')->latest()->paginate(10);
        } 
        
        elseif ($user->hasRole('Admin')) {
            $users = User::with('organization')->where('organization_id', $user->organization_id)->latest()->paginate(10);
        } 
        
        else {
            $users = User::where('id', $user->id)->latest()->paginate(10);
        }
    
        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      
        $organizations = Organization::all(); 
        return view('users.create', [
            'organizations' => $organizations,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        try {

            
            // dd($request->toArray());
            DB::beginTransaction();
            $createdUser = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'lang'      => $request->lang,
                'organization_id' => 1
            ]);
            // dd($createdUser);
            $createdUser->assignRole($request['role']);
            DB::commit();
            return redirect()->route('users.index')
                ->withSuccess(__('User created successfully.'));
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->withErrors(['msg' => 'Failed To create users']);
        }
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
{
    $currentUser = auth()->user();
    
    
    if ($currentUser->hasRole('Super Admin')) {
        return view('users.show', ['user' => $user]);
    } 
    
    elseif ($currentUser->hasRole('Admin') && $user->organization_id == $currentUser->organization_id) {
        return view('users.show', ['user' => $user]);
    } 
    
    elseif ($user->id === $currentUser->id) {
        return view('users.show', ['user' => $user]);
    } 
    
    else {
        abort(403);
    }
}

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        
        $organizations = Organization::all(); 

        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get(),
            'organizations' => $organizations,
        ]);
    }
    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
   {
    // dd($request->all());
    // Validate request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        // 'lang' => 'required|string|in:en,gr',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Update user data
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->username = $request->input('username');
    // $user->lang = $request->input('lang');

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    // Save user
    $user->save();

    // Redirect or return response
    return redirect()->back()->withSuccess(['msg' => 'Updated Successfully']);
   }


    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->back()->withSuccess('Password updated successfully.');
    }
    public function updateAdminPassword(Request $request, User $user)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string|confirmed|min:8',
    ]);

    $user->update([
        'username' => $request->username,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->back()->with('success', 'Password updated successfully');
}
}
