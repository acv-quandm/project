<?php

namespace App\Http\Controllers\Api;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class DepartmentController extends Controller
{
    private $table = 'departments';

    public function index(Request $request)
    {
        $data = Department::with('lecturers');
        if($request->has('query'))
        {
            $columns = Schema::getColumnListing('departments');
            $data->where(function ($query) use ($columns,$request){
                foreach ($columns as $column)
                {
                    $query->orWhere($column,'%like%',$request->query);
                }
            });
        }
        if($request->has('limit'))
        {
            return $data->paginate($request->limit);
        }
        return $data->paginate(30);
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
            $department = new Department();
            foreach ($keys as $key)
            {
                if(in_array($key,$columns))
                {
                    $department->$key = $request->input($key);
                }
            }
            $department->save();
            return $department;
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
            $department = Department::findOrFail($id);
            foreach ($keys as $key)
            {
                if(in_array($key,$columns))
                {
                    $department->$key = $request->input($key);
                }
            }
            $department->save();
            return $department;
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
        $department = Department::findOrFail($id);
        $department->lecturers()->delete();
        $department->delete();
        return $department;
    }
}
