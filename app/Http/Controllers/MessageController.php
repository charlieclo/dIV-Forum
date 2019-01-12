<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int @receiver_id
     * @return \Illuminate\Http\Response
     */
    public function index($receiver_id, $receiver_name)
    {
        $messages = Message::where('receiver_id', $receiver_id)->paginate(10);
        
        return view('user.inbox', compact('messages'));
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
     * @param  int $receiver_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $receiver_id)
    {
        $messages = New Message;
        $messages->content = $request->content;
        $messages->sender_id = Auth::user()->id;
        $messages->receiver_id = $receiver_id;
        $messages->save();

        return back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $message_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($message_id)
    {
        $message = Message::find($message_id);
        $message->delete();
        return back();
    }
}
