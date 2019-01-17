<?php

namespace App\Http\Controllers\Api;

use App\Lecturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class LecturerController extends Controller
{
    private $table = 'lecturers';

    public function index(Request $request)
    {
        $data = Lecturer::with(['department']);

        if($request->has('query'))
        {
            if($request->input('query') != null && $request->input('query') != '')
            {
                $columns = Schema::getColumnListing('lecturers');

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
            $lecture = new Lecturer();
            foreach ($keys as $key)
            {
                if(in_array($key,$columns))
                {
                    $lecture->$key = $request->input($key);
                }
            }
            $lecture->save();
            return $lecture;
        }catch (\Exception $exception)
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
            $lecture = Lecturer::findOrFail($id);
            foreach ($keys as $key)
            {
                if(in_array($key,$columns))
                {
                    $lecture->$key = $request->input($key);
                }
            }
            $lecture->save();
            return $lecture;
        } catch (\Exception $exception)
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
        $lecture = Lecturer::findOrFail($id);
        $lecture->delete();
        return $lecture;
    }
}
