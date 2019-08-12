<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use URL;

class SyncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sync()
    {
        $data = DB::table('wp_nci_community')->where('status', '1')->get();
        // for($i = 1; $i<=100; $i ++){
        //     $data=DB::table('wp_nci_community')->insert([
        //         'name_community' => 'a_'.$i,
        //         'city' => 'ngawi',
        //         'community_category' => '1',
        //         'id_users' => '1',
        //         'community_total_member' => '1',
        //         'community_motto' => 'yea',
        //         'community_logo' => 'yea',
        //         'description' => 'yea',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //         'status' => '1',
        //     ]);
        // }
        return view('sync', compact('data')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
