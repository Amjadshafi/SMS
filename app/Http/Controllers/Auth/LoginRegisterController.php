<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
        ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            if(Auth()->user()->roles[0]->name == 'Super Admin')
                return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
            else
                return redirect()->route('userdashboard')->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    } 
    
    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    // Controller

public function dashboard()
{
    if(Auth::check())
    {
        $complaint = new Complaint();
        $pending = $complaint->where('status',0)->count();
        $in_process = $complaint->where('status',1)->count();
        $canceled = $complaint->where('status',2)->count();
        $completed = $complaint->where('status',3)->count();
        $totalComplaints = $pending+$in_process+$canceled+$completed;

        $complaints = $complaint->getCountsGroupByEmail();
        $allComplaints = $complaint->getAllComplaintsWithDeadlines();
        return view('dashboard', compact('pending', 'in_process','canceled','completed','totalComplaints','complaints', 'allComplaints'));
    }
    return redirect()->route('login')
        ->withErrors([
        'email' => 'Please login to access the dashboard.',
    ])->onlyInput('email');
}

    
    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
    
    

    public function changeLanguage(Request $request){
        dd($request->toArray());
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }

    public function changelang($locale){
        dd($locale);
        app()->setLocale($locale);
                session()->put('locale', $locale);
                return redirect()->back();
    }

}