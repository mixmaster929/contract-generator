<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Templates;
use App\Models\User;
use App\Models\ShortCodes;
use Illuminate\Support\Facades\Auth;
class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $templates = Templates::where('user_id', $user_id)->get();
        return view('backend.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = new Templates();
        $users = User::all();
        $shortcodes = ShortCodes::all();
        return view('backend.templates.create', compact('template', 'shortcodes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $name = $request->name;
        $content = $request->content;
        $templates = Templates::create(["user_id" => $user_id, "name" => $name, "content" => $content]);
        
        return redirect()->route('backend.templates.index')->with('success', 'Template saved successfully');
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
        $template = Templates::find($id);
        $shortcodes = ShortCodes::all();
        return view('backend.templates.edit', compact('template', 'shortcodes'));
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
        $user_id = Auth::user()->id;
        $name = $request->name;
        $content = $request->content;
        $template = Templates::find($id);
        $templates = $template->update(["user_id" => $user_id, "name" => $name, "content" => $content]);
        
        return redirect()->route('backend.templates.index')->with('success', 'Template updated successfully');
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
