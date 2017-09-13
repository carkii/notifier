<?php

namespace Carkii\Notifier\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carkii\Notifier\model\notification;
use response;
use Auth;

class NotifierController extends Controller
{
    public function acknowledged(Request $request)
    {   
        if(Auth::guest())
            return abort(401);
        
    	$notification = notification::create(
    		[
    			'name' => $request->input('name'),
    			'user_id' => Auth::User()->id ,
    		]
    	);        
    	return ['message' => 'Acknowledged'];
    }
}
