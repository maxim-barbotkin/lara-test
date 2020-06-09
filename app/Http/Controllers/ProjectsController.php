<?php

namespace App\Http\Controllers;

use App\Projects;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$page_num = 1, $per_page = 10)
    {
        // TODO :: pagination

        $projects = Projects::paginate($request->per_page <= 100 ? $request->per_page : $per_page, ['*'], 'page', $request->page > 0 ? $request->page : $page_num);

        return response()->json($projects->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->toArray();
        $dataForCreate = collect($data)->only(['name','description','status'])->toArray();
        $validationResult = Validator::make($data,[
            'status' => [
                'required',
                Rule::in([
                    'planned',
                    'Planned',
                    'running',
                    'Running',
                    'on hold',
                    'On hold',
                    'finished',
                    'Finished',
                    'cancel',
                    'Cancel'
                ]),
            ],
            'name' => ['required']
        ])->passes();
        if($validationResult){
            $response = Projects::create($dataForCreate);
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
        $project = Projects::where('id',$id)->first();
        if($project){
            return response()->json($project->toArray());
        }else{
            return response()->json([
                'error' => 'record not found with '.$id.' id',
                'code' => '404'
            ]);
        }
    }


    /**
     * update record
     *
     * @param Request $request
     * @param str $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->toArray();
        $dataForUpdate = collect($data)->only(['name','description','status'])->toArray();
        if($this->validateStatus($data)){
            // TODO :: if not exists
            $project = Projects::where('id',$id)->first();
            if($project){
                return response()->json($project->update($dataForUpdate));
            }else{
                return response()->json([
                    'error' => 'record not found with '.$id.' id',
                    'code' => '404'
                ]);
            }
        }else{
            return response()->json([
                'status' => 'data not valid',
                'code' => '422'
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
        $project = Projects::where('id',$id)->first();
        if($project){
            return response()->json($project->delete());
        }else{
            return response()->json([
                'error' => 'record not found with '.$id.' id',
                'code' => '404'
            ]);
        }
    }

    /**
     * validation status
     *
     * @return bool
     */
    public function validateStatus($data){
        return Validator::make($data,[
            'status' => [
                Rule::in([
                    'planned',
                    'Planned',
                    'running',
                    'Running',
                    'on hold',
                    'On hold',
                    'finished',
                    'Finished',
                    'cancel',
                    'Cancel'
                ]),
            ],
        ])->passes();

    }
}
