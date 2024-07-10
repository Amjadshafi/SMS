<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    protected $Organization;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function index()
    {
        $organizations = $this->organization->with('complaints')->get();
        $organizationData = [];
        foreach ($organizations as $organization) {
            $organizationData[$organization->name] = $organization->complaints->count();
        }
        return view('organizations.index', compact('organizations', 'organizationData'));
    }

    public function create()
    {
        return view('organizations.create');
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //     ]);

    //     Organization::create($validatedData);

    //     return redirect()->route('organizationsList')->with('success', 'Organization created successfully.');
    // }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Check if organization with the same email already exists
        $existingOrganization = Organization::where('email', $validatedData['email'])->first();

        if ($existingOrganization) {
            // Handle duplicate email scenario, such as updating existing record or displaying an error message
            // For example:
            return redirect()->back()->with('error', 'An organization with this email already exists.');
        }

        Organization::create($validatedData);

        return redirect()->route('organizationsList')->with('success', 'Organization created successfully.');
    }
    public function show($id)
    {
        $organization = $this->organization->findOrFail($id);
        return view('organizations.show', compact('organization'));
    }

    public function edit($id)
    {
        $organization = $this->organization->findOrFail($id);
        return view('organizations.edit', compact('organization'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Find the organization by ID
        $organization = $this->organization->findOrFail($id);

        // Update organization attributes
        $organization->name = $validatedData['name'];
        $organization->email = $validatedData['email'];
        $organization->save();

        return redirect()->route('organizationsList')->with('success', 'Organization updated successfully.');
    }
}
