<?php

namespace App\Http\Controllers;

use App\Phonebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phonebooks = Phonebook::latest()->paginate(5);

        return view('phonebooks.index',compact('phonebooks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phonebooks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'number' => ['required', 'string', 'digits_between:10,20'],
        ]);

        Phonebook::create($request->all());

        return redirect()->route('phonebooks.index')
            ->with('success','Number created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook  $data
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Phonebook::find($id);
        return view('phonebooks.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook  $data
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Phonebook::find($id);
        return view('phonebooks.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonebook  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'number' => ['required', 'string', 'digits_between:10,20'],
        ]);

        $data = Phonebook::find($id);
        $data->name =  $request->get('name');
        $data->number = $request->get('number');
        $data->save();

        return redirect()->route('phonebooks.index')
            ->with('success','Number updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Phonebook::find($id);
        $data->delete();
        return redirect()->route('phonebooks.index')
            ->with('success','Number deleted successfully');
    }
}
