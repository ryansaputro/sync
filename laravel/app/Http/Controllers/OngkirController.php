<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use URL;
use App\Community;
use File;
use Ixudra\Curl\Facades\Curl;


class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // protected $connection = 'secondary';

    public function index()
    {
        $data = Curl::to('https://api.rajaongkir.com/starter/province')->withHeader('key: cba0c38338fcf71e9b979bbcf7bfdd3f')->get();
        $ongkirs = json_decode($data, true);
        $ongkir = $ongkirs['rajaongkir']['results'];
        return view('ongkir', compact('ongkir'));
    }

    public function AjaxProvince(Request $request)
    {
        $data = Curl::to('https://api.rajaongkir.com/starter/city?province='.$request->id)->withHeader('key: cba0c38338fcf71e9b979bbcf7bfdd3f')->get();
        $ongkirs = json_decode($data, true);
        $city = $ongkirs['rajaongkir']['results'];
        return response()->json(["city"=> $city]);
    }

    public function cekOngkos(Request $request)
    {
        $response = Curl::to('https://api.rajaongkir.com/starter/cost')
                        ->withHeader('key: cba0c38338fcf71e9b979bbcf7bfdd3f')
                        ->withData( array( 'origin' => $request->kota_asal, 'destination' => $request->kota_tujuan , 'weight' => $request->berat, 'courier' => $request->kurir) )
                        ->post();
        $ongkirs = json_decode($response, true);
        $cost = $ongkirs['rajaongkir']['results'];
        return view('ongkir_result', compact('cost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function syncServer(Request $request)
    {
        $txt = "";
        $dir = public_path("/riwayat/");
        if(!is_dir($dir)){$makeFolder = mkdir($dir , 0777, true);}

        DB::beginTransaction();
        try {
            $db = DB::table('wp_nci_community')->select('*')->where('status', '1')->get();
            foreach($db AS $k => $v){ 
                // if($txt){
                    $txt .= date('Y-m-d H:i:s')." - ".$v->name_community.", ";
                // }
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
            $data = $txt;
            $filename = $dir.'riwayat-'.date('Y-m-d').".txt";

            if (file_exists($filename)) {
                File::append($filename, $data);
            }else{
                File::put($filename, $data);
            }
            
            
        } catch (\Illuminate\Database\QueryException $ex) {
            //throw $th;
            DB::rollback();
            dd($ex->getMessage()); 
            return response()->json(["data"=>"sync fail"]);
        }
        DB::commit();
        return response()->json(["data"=>"sync done", "sync" => $txt]);
        

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
