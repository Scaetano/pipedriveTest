<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Organization;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization = Organization::all();

        return response()->json(['success' => true,'data' => $organization]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $organization = new Organization;
        $organization->name = $request->name;

        $organization->save();

        return response()->json(['success' => true,'data' => $organization]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organization = Organization::find($id);

        if(!$organization){

            return response()->json(['success' => false, 'error' => 'Organization not found!']);
        }

        return response()->json(['success' => true, 'data' => $organization]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $organization = Organization::find($id);

        if(!$organization){
            return response()->json(['success' => false, 'error' => 'Organization not found!']);
        }

        $organization->name = $request->name;

        $organization->save();

        return response()->json(['success' => true, 'data' => $organization]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization = Organization::find($id);

        if(!$organization){
            return response()->json(['success' => false, 'error' => 'Organization not found!']);
        }

        $organization->delete();

        return response()->json(['success' =>  false, 'message' => 'Organization deleted!']);
    }
}
