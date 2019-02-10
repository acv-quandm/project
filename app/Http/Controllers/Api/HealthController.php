<?php

namespace App\Http\Controllers\Api;

use App\Health;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class HealthController extends Controller
{
    public $table = 'healths';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Health::with(['lecturer','drugs','drugs_health']);

        if($request->has('query'))
        {
            if($request->input('query') != null && $request->input('query') != '')
            {
                $columns = Schema::getColumnListing('healths');

                $data->where(function ($query) use ($columns,$request){
                    foreach ($columns as $column)
                    {
                        $query->orWhere($column,'like','%'.$request->input('query').'%');
                    }
                    $query->orWhereHas('lecturer',function($queryHas) use ($request){
                        $queryHas->where('name','like','%'.$request->input('query').'%');
                    });
                });

            }
        }
        if($request->has('lecturer_id'))
        {
            $data->where('lecturer_id','=',$request->lecturer_id);
        }
        if($request->has('limit'))
        {
            return $data->orderBy('updated_at','desc')->paginate($request->limit);
        }

        return $data->orderBy('updated_at','desc')->paginate(30);
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
            $health = new Health();
            foreach ($keys as $key)
            {
                if(in_array($key,$columns))
                {
                    $health->$key = $request->input($key);
                }
            }
            $health->save();
            if($request->has('drugs_health'))
            {
                $health->drugs()->sync($request->drugs_health);
            }
            return $health;
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
            $health = Health::findOrFail($id);
            foreach ($keys as $key)
            {
                if(in_array($key,$columns))
                {
                    $health->$key = $request->input($key);
                }
            }
            $health->save();
            if($request->has('drugs_health'))
            {
                $health->drugs()->sync($request->drugs_health);
            }
            return $health;
        }catch (\Exception $exception)
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
        //
    }
}
