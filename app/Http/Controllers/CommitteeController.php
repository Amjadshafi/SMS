<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Committe;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommitteeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Check if the user is a superadmin
        if ($user->role === 'superadmin') { // Assuming role is a field in the user table
            // Fetch all committees for the organization
            $committees = Committe::with('users')->get();
        } else {
            // Fetch committees only for the logged-in user's organization
            $committees = Committe::where('organization_id', $user->organization_id)->with('users')->get();
        }
    
        return view('committee.index', ['committees' => $committees]);
    }
    
    public function create()
    {
        $organizations = Organization::all();
        $users = User::all(); // Fetch all users but with the respect of logedin user.
        return view('committee.create', ['organizations' => $organizations, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request['name'],
            'organization_id' => Auth()->user()->organization_id
        ];
        $committee = Committe::create($data);

        // Attach selected users to the committee
        if ($request->has('user_id')) {
            $committee->users()->attach($request->input('user_id'));
        }

        return redirect()->route('allcommittees')->with('success', 'Committee created successfully!');
    }

    public function show($id)
    {
        $committee = Committe::findOrFail($id); // Corrected model name
        return view('committee.show', ['committee' => $committee]);
    }

    public function edit($id)
    {
        $committee = Committe::findOrFail($id);
        $organizations = Organization::all(); // Fetch all organizations
        $users = User::all(); // Fetch all users
        return view('committee.edit', ['committee' => $committee, 'organizations' => $organizations, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $committee = Committe::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'organization_id' => 'required|exists:organizations,id',
        ]);

        $committee->update($data);
        return redirect()->route('committees.show', ['id' => $committee->id]);
    }
}
