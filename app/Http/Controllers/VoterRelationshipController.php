<?php

namespace App\Http\Controllers;

use App\VoterRelationship;
use App\User;
use Illuminate\Http\Request;

class VoterRelationshipController extends Controller
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
    public function create($vote_giver, $vote_receiver, $type)
    {
        $voter_relationship = VoterRelationship::where('vote_giver', $vote_giver)->where('vote_receiver', $vote_receiver)->first();
        if($voter_relationship == null){
            $vote = New VoterRelationship;
            $vote->vote_giver = $vote_giver;
            $vote->vote_receiver = $vote_receiver;
            $vote->type = $type;
            $vote->save();
    
            $user = User::find($vote_receiver);
            if($type == 1){
                $user->plus_popularity += 1;
            }
            else {
                $user->minus_popularity += 1;
            }
            $user->save();
        }
        else {
            if($voter_relationship->type != $type){
                $voter_relationship->type = $type;
                $voter_relationship->save();

                $user = User::find($vote_receiver);
                if($type == 1){
                    $user->plus_popularity += 1;
                    $user->minus_popularity -= 1;
                }
                else {
                    $user->plus_popularity -= 1;
                    $user->minus_popularity += 1;
                }
                $user->save();
            }
            else {
                $voter_relationship->delete();
                $user = User::find($vote_receiver);
                if($type == 1){
                    $user->plus_popularity -= 1;
                }
                else {
                    $user->minus_popularity -= 1;
                }
                
                $user->save();
            }
        }

        return redirect('profile/'.$vote_receiver);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VoterRelationship  $voterRelationship
     * @return \Illuminate\Http\Response
     */
    public function show(VoterRelationship $voterRelationship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VoterRelationship  $voterRelationship
     * @return \Illuminate\Http\Response
     */
    public function edit(VoterRelationship $voterRelationship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VoterRelationship  $voterRelationship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VoterRelationship $voterRelationship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VoterRelationship  $voterRelationship
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoterRelationship $voterRelationship)
    {
        //
    }
}
