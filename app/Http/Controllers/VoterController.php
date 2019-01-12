<?php

namespace App\Http\Controllers;

use App\Voter;
use App\User;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int $vote_sender
     * @param  int $vote_receiver
     * @param  int $status
     * @return \Illuminate\Http\Response
     */
    public function store($vote_sender, $vote_receiver, $status)
    {
        $voter = Voter::where('vote_sender', $vote_sender)->where('vote_receiver', $vote_receiver)->first();
        
        if($voter == null) {
            $voter = New Voter;
            $voter->vote_sender = $vote_sender;
            $voter->vote_receiver = $vote_receiver;
            $voter->status = $status;
            $voter->save();
    
            $user = User::find($vote_receiver);
            
            if($status == 1) {
                $user->good_vote += 1;
            }

            else {
                $user->bad_vote += 1;
            }

            $user->save();
        }

        else {
            if($voter->status != $status) {
                $voter->status = $status;
                $voter->save();

                $user = User::find($vote_receiver);
                if($status == 1) {
                    $user->good_vote += 1;
                    $user->bad_vote -= 1;
                }
                
                else {
                    $user->good_vote -= 1;
                    $user->bad_vote += 1;
                }
                
                $user->save();
            }

            else {
                $voter->delete();
                $user = User::find($vote_receiver);
                
                if($status == 1) {
                    $user->good_vote -= 1;
                }
                
                else {
                    $user->bad_vote -= 1;
                }
                
                $user->save();
            }
        }

        return redirect('profile/'.$vote_receiver);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
