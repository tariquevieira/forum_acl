<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReplyRequest;

class ReplyController extends Controller
{
    public function store(ReplyRequest $request)
    {
    	try{
    		$reply =$request->all();
    		$reply['user_id']=1;
    		$thread = \App\Thread::find($request->thread_id);
    		$thread->replies()->create($reply);
    		flash('Tópico atualizado')->success();
    		return redirect()->back();
    	}catch(\Exception $e){
    		$message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar sua requisição';
            flash($message)->error();
            return redirect()->back();
    		
    	}
    }
}
