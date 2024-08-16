<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class contactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();
        
        // Search by name or email
        if ($request->input('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('email', 'like', '%' . $request->input('search') . '%');
        }
        
        // Sort by name or created_at
        if ($request->input('sort')) {
            $query->orderBy($request->input('sort'), $request->input('direction', 'asc'));
        }

        $contacts = $query->get();

        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Contact::create($validatedData);

        return redirect('/contacts')->with('success', 'Contact created successfully!');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email,' . $id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($validatedData);

        return redirect('/contacts')->with('success', 'Contact updated successfully!');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect('/contacts')->with('success', 'Contact deleted successfully!');
    }
}

