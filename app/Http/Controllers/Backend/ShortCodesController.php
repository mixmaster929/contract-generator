<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShortCodes;
use App\Http\Requests\Backend\Shortcode\StoreShortcodeRequest;
use App\Http\Requests\Backend\Shortcode\UpdateShortcodeRequest;
use Illuminate\Support\Facades\Auth;


class ShortCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = ShortCodes::all();
        // $users = User::all();
        // dd($codes->count());
        return view('backend.shortcodes.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = new ShortCodes();
        return view('backend.shortcodes.create', compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortcodeRequest $request)
    {
        $shortcodes = $request->shortcodes;
        $user_id = Auth::user()->id;
        $shortcodes = ShortCodes::create(["user_id" => $user_id, "shortcodes" => $shortcodes]);
        // $shortcodes = ShortCodes::create($request->all());
        return redirect()->route('backend.shortcodes.index')->with('success', 'Shortcode saved successfully');
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
        $code = ShortCodes::find($id);
        return view('backend.shortcodes.edit', compact('code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShortcodeRequest $request, $id)
    {
        $code = ShortCodes::find($id);
        $shortcodes = $request->shortcodes;
        $user_id = Auth::user()->id;
        $shortcodes = $code->update(["user_id" => $user_id, "shortcodes" => $shortcodes]);

        // $code->update([
        //     'name' => $request->name,
        //     'shortcodes' => $request->shortcodes
        // ]);
        
        return redirect()->route('backend.shortcodes.index')->with('success', 'Shortcode updated successfully');
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
