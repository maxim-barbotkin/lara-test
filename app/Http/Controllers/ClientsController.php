<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $per_page = 10, $page_num =1)
    {
        // TODO :: pagination
        $clients = Clients::paginate($request->per_page <= 100 ? $request->per_page : $per_page, ['*'], 'page', $request->page > 0 ? $request->page : $page_num);

        return response()->json($clients->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->toArray();
        $dataForCreate = collect($data)->only(['f_name','l_name','email','password'])->toArray();
        $validationRedsult = Validator::make($data,[
            'l_name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
        ])->passes();
        if($validationRedsult){
            $response = Clients::create($dataForCreate);
            return response()->json($response);
        }else{
            return response()->json([
                'status' => 'data not valid',
                'code' => '422'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Clients::where('id',$id)->first();
        if($client){
            return response()->json($client->toArray());
        }else{
            return response()->json([
                'error' => 'record not found with '.$id.' id',
                'code' => '404'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Clients::where('id',$id)->first();
        if($client){
            return response()->json($client->delete());
        }else{
            return response()->json([
                'error' => 'record not found with '.$id.' id',
                'code' => '404'
            ]);
        }
    }
}
