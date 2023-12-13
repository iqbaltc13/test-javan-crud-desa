<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndonesiaProvince;
use App\Models\IndonesiaCity;
use App\Models\IndonesiaDistrict;
use App\Models\IndonesiaVillage;
use Illuminate\Database\QueryException;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use DB;
use stdClass;
use DateTime;
use DateInterval;
use Validator;


class DesaController extends Controller
{
    //
    public function __construct()
    {
        
    }
    public function index(Request $request){

        $data = IndonesiaVillage::with([])->get();
        $response = [
            'response_code'=>200,
            'message'=>'Success',
            // /'token' => $token,
            'data'=>$data,


        ];
        return response($response, 200);
    }
    public function store(Request $request){
        $this->validate($request, [

            'district_code'            => 'required',
            'name'                     => 'required',
           
            'lat'                      => 'required|numeric',
            'long'                     => 'required|numeric',
            'pos'                      => 'required'

        ]);
        $dateTime = new DateTime();
        DB::beginTransaction();
        $meta = new stdClass();
        $meta->lat =  $request->lat;
        $meta->long = $request->long;
        $meta->pos = $request->pos;
        $maxCode = IndonesiaVillage::with([])->where('district_code',$request->district_code)->max('code');
        $code = (int)$maxCode + 1;
        

        try {
            $data = IndonesiaVillage::create([
                'name'                  => $request->name,
                'district_code'         => $request->district_code,
                'code'                  =>''.$code.'',
                'meta'                  => json_encode($meta),
            ]);

           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            $response = [
                'response_code'=>401,
                'message'=>'Error Query',
                // /'token' => $token,
                'data'=>NULL,
    
    
            ];
            return response($response, 401);
            // something went wrong
        }
        $response = [
            'response_code'=>200,
            'message'=>'Success',
            // /'token' => $token,
            'data'=>$data,


        ];
        return response($response, 200);
        

    }
    public function update(Request $request, $id){
        
        $this->validate($request, [
            'name'                     => 'required',
           
            'lat'                      => 'required|numeric',
            'long'                     => 'required|numeric',
            'pos'                      => 'required'

        ]);
        $dateTime = new DateTime();
        DB::beginTransaction();
        $meta = new stdClass();
        $meta->lat =  $request->lat;
        $meta->long = $request->long;
        $meta->pos = $request->pos;
        
        

        try {
            $data = IndonesiaVillage::where('id',$id)->first();
            
            if($data){
                $data->name = $request->name;
                $data->meta = json_encode($meta);
                $data->save();

            }
            

           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            $response = [
                'response_code'=>401,
                'message'=>'Error Query',
                // /'token' => $token,
                'data'=>NULL,
    
    
            ];
            return response($response, 401);
            // something went wrong
        }
        $response = [
            'response_code'=>200,
            'message'=>'Success',
            // /'token' => $token,
            'data'=>$data,


        ];
        return response($response, 200);

    }
    public function detail(Request $request, $id){
        $data = IndonesiaVillage::with(['district.city.province'])->where('id',$id)->first();
        $response = [
            'response_code'=>200,
            'message'=>'Success',
            // /'token' => $token,
            'data'=>$data,


        ];
        return response($response, 200);
    }
    public function delete(Request $request, $id){
        try {
            $data = IndonesiaVillage::where('id',$id)->first();
            if($data){
                $response = [
                    'response_code'=>200,
                    'message'=>'Success Delete Desa '.$data->name,
                    // /'token' => $token,
                    'data'=> NULL,
        
        
                ];
                $data->delete();

            }
            

           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            $response = [
                'response_code'=>401,
                'message'=>'Error Query',
                // /'token' => $token,
                'data'=>NULL,
    
    
            ];
            return response($response, 401);
            // something went wrong
        }
        
        return response($response, 200);

    
    }   
}
