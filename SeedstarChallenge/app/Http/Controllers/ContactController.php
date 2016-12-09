<?php

namespace SeedStar\Http\Controllers;

use Illuminate\Http\Request;
use Model\seedStar;
use SeedStar\Http\Requests;

class ContactController extends Controller
{
    protected $rules = [
        'name' => 'required|alpha',
        'email' => 'required|email'
    ];

    protected $messages = [
        'required'=>'This field is required',
        'email'=>'please enter appropriate email'
    ]
    public function index()
    {
        return view('contact.index');
    }

    public function list()
    {
        $contact = SeedStar:all;

        return view('contact.index', compact('contacts'));
    }


    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);

        $input = Input::all();
        seedStar::create( $input );

        return Redirect::route('contact.index')->with('message', 'Contact created');
    }

    public function edit(SeedStar $seedstar)
    {
        return view('contact.edit', compact('seedstar'));
    }


    public function update(SeedStar $seedstar, Request $request)
    {
        $this->validate($request, $this->rules);

        $input = array_except(Input::all(), '_method');
        $seedstar->update($input);

        return Redirect::route('contact.show', $project->slug)->with('message', 'Contact updated.');
    }

    public function destroy(SeedStar $seedstar)
    {
            $seedstar->delete();

            return Redirect::route('contact.index')->with('message', 'Contact deleted.');
    }

    public function show(SeedStar $seedstar)
    {
        return view('contact.show', compact('seedstar'));
    }


}
