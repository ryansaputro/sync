<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use URL;
use App\Community;
class SyncServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $connection = 'secondary';

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function syncServer(Request $request)
    {
        $pdo = DB::connection('secondary')->getPdo();
        DB::beginTransaction();
        try {
            $myArray = json_decode($request->id);
            $nama = json_decode(html_entity_decode($request->nama));//);
            $db = DB::table('wp_nci_community')->select('*')->where('status', '1')->get();
            foreach($db AS $k => $v){
                $insert = Community::create([
                    'id_community' => $v->id_community,
                    'name_community' => $v->name_community,
                    'city' => $v->city,
                    'community_category' => $v->community_category,
                    'id_users' => $v->id_users,
                    'community_total_member' => $v->community_total_member,
                    'community_motto' => $v->community_motto,
                    'community_logo' => $v->community_logo,
                    'community_background' => $v->community_background,
                    'description' => $v->description,
                    'created_at' => $v->created_at,
                    'updated_at' => $v->updated_at,
                    'status' => $v->status,
                    'contact_person' => $v->contact_person,
                    'base_camp' => $v->base_camp,
                ]);
                $update = DB::table('wp_nci_community')->where('id_community', $v->id_community)->update(['status' => '0']);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            //throw $th;
            DB::rollback();
            dd($ex->getMessage()); 
            return response()->json(["data"=>"sync fail"]);
        }
        DB::commit();
        return response()->json(["data"=>"sync done"]);
        

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
