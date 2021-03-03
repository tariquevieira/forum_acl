<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    User,
    Thread,
    Channel
};
use Illuminate\Support\Str;
use App\Http\Requests\ThreadRequest;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;     
    }

    public function index(Request $request)
    {
        $channelParam =$request->channel;
        if(null !==$channelParam){
            $threads = Channel::whereSlug($channelParam)->first()->threads()->paginate(15);
        }else{
            $threads = $this->thread->orderBy('created_at','DESC')->paginate(15);    
        }
        
        return view('threads.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Channel $channels)
    {
        
        return view('threads.create',['channels'=>$channels->all()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        try{
            $thread=$request->all();

            $thread['slug'] = Str::slug($thread['title']);
                
            $user = User::find(1);
            $thread = $user->threads()->create($thread);
            flash('Tópico criado com Sucesso')->success();
            return redirect()->route('threads.show',$thread->slug);
        }catch(\Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar sua requisição';
            flash($message)->error();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($thread)
    {
       $thread = $this->thread->whereSlug($thread)->first();

        if(!$thread) return redirect()->route('threads.index');

        return view('threads.show',compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();

        return view('threads.edit',compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, $thread)
    {

         try{
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->update($request->all());
            flash('Tópico atualizado')->success();
            return redirect()->route('threads.show',$thread->slug);
        }catch(\Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar sua requisição';
            flash($message)->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread)
    {
         try{
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->delete();
            flash('Tópico atualizado')->success();
            return redirect()->route('threads.index');
        }catch(\Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar sua requisição';
            flash($message)->error();
            return redirect()->back();
        }
    }
}
