<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getMovements(){
        $results = DB::select("SELECT * FROM movement");
        return response()->json($results);
    }

    public function getUsers(){
        $results = DB::select("SELECT * FROM user");
        return response()->json($results);
    }

    public function getRecords(){
        $results = DB::select("SELECT * FROM personal_record");
        return response()->json($results);
    }

    public function movementStatistics($id){
        $results = DB::select("SELECT m.name as `movement`, u.name, max(r2.value) as `value` 
        FROM personal_record r2 
        INNER JOIN movement m ON m.id = r2.movement_id
        INNER JOIN user u ON u.id = r2.user_id
        WHERE m.id = ?
        GROUP BY r2.movement_id, user_id", [$id]);        
        
        $position = 0;
        for ($i=0; $i < count($results); $i++) { 
            if(!(isset($results[$i-1]) && $results[$i-1]->value == $results[$i]->value)){
                $position++;
            }
            $results[$i]->position = $position;
        }
        return response()->json($results);
    }

}
