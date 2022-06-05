<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VersionControl;
use App\Traits\ApiResponser;
use Carbon\Carbon;

class VersionControlController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VersionControl::all();

        if(!empty($data)){
            return $this->successResponse($data, 'Get Value Successfully', 200);
        }else{
            return $this->errorResponse('There is no record found', 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        foreach($requestData as $key => $value){
            $version_control = VersionControl::create([
                'key' => $key,
                'value' => json_encode($value),
                'unix_timestamp' => Carbon::now()->timestamp
            ]);
        }

        return $this->successResponse($version_control, 'Version Control Store Successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $key)
    {
        
        if($request->timestamp){
            $data = VersionControl::where('key', $key)->where('unix_timestamp', '<=', $request->timestamp)->latest()->first();
            
            if($data){
                return $this->successResponse($data->value, 'Get Value Successfully', 200);
            }else{
                return $this->errorResponse('Invalid key or timestamp', 422);
            }

        }else{
            $data = VersionControl::where('key', $key)->latest()->first();

            if($data){
                return $this->successResponse($data->value, 'Get Value Successfully', 200);
            }else{
                return $this->errorResponse('Invalid key', 422);
            }
        }
        

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
