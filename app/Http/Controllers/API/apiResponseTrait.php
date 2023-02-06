<?php

namespace App\Http\Controllers;

trait apiResponseTrait{

public function apiResponse($data=null,$message=null,$status=null){

    $array=[
        'data'=>$data,
        'message'=>$message,
        'status'=>$status,
    ];
    return reponse()->json($array,$status);
}

}
