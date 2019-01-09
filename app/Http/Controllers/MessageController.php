<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $message_id = -1)
    {
        $messages = Message::where('receiver_id', $id)->paginate(10);
        return view('inbox', compact('messages', 'message_id'));
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
    public function store(Request $request, $user_id)
    {
        $messages = New Message;
        $messages->content = $request->content;
        $messages->sender_id = Auth::user()->id;
        $messages->receiver_id = $user_id;
        $messages->save();
        return back();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($message_id)
    {
        $message = Message::find($message_id);
        $message->delete();
        return back();
    }
    
    public function reply($id, $message_id = -1)
    {
        return $this->index($id, $message_id);
    }

    public function sendReply(Request $request, $user_id) {
        $messages = New Message;
        $messages->content = $request->content;
        $messages->sender_id = Auth::user()->id;
        $messages->receiver_id = $user_id;
        $messages->save();
        return $this->index(Auth::user()->id, -1);
    }
}
