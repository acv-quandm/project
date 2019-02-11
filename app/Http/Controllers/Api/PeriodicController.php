<?php

namespace App\Http\Controllers\Api;

use App\Department;
use App\Health;
use App\Periodic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class PeriodicController extends Controller
{
    private $table = 'periodics';
    public function index(Request $request)
    {
        $data = new Periodic();

        if($request->has('query'))
        {
            if($request->input('query') != null && $request->input('query') != '')
            {
                $columns = Schema::getColumnListing('periodics');

                $data->where(function ($query) use ($columns,$request){
                    foreach ($columns as $column)
                    {
                        $query->orWhere($column,'like','%'.$request->input('query').'%');
                    }
                });

            }
        }
        if($request->has('limit'))
        {
            $data = $data->paginate($request->limit);
        }
        else{
            $data = $data->paginate(30);
        }
        return $data;
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
        try{
            $columns = Schema::getColumnListing($this->table);
            $keys = $request->keys();
            $periodic =  new Periodic();
            foreach ($keys as $key)
            {
                if(in_array($key,$columns))
                {
                    $periodic->$key = $request->input($key);
                }
            }
            $periodic->save();
            return $periodic;
        }
        catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage()
            ],403);
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
        try{
            $columns = Schema::getColumnListing($this->table);
            $keys = $request->keys();
            $periodic = Periodic::findOrFail($id);
            foreach ($keys as $key)
            {
                if(in_array($key,$columns))
                {
                    $periodic->$key = $request->input($key);
                }
            }
            $periodic->save();
            return $periodic;
        }
        catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage()
            ],403);
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
        $periodic = Periodic::findOrFail($id);
        $periodic->delete();
        return $periodic;
    }
    public function report($id){
        $periodic = Periodic::with(['healths.lecturer'])->findOrFail($id);
        $departments = Department::get();
        $labels = [];
        foreach ($departments as $department){
            $labels[] = $department->name;
        }
        $data = [];
        foreach ($departments as $department){
            $count = 0;
            foreach ($periodic->healths as $health){
                if($health->lecturer->department_id == $department->id){
                    $count++;
                }
            }
            $data[] = $count;
        }
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
