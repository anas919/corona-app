<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Province;

class UserController extends Controller
{
    public function index(Request $request)
	{
		$users = User::all();
		$provinces = Province::all();

		return view('users.index',['users'=>$users, 'provinces'=>$provinces]);
	}
	public function create()
    {
        return view('users.create');
    }

	public function store(Request $request)
	{
		$user = new User();
		$user->name = $request->name;
		$user->gender = $request->gender;
		$user->age = $request->age;
		$user->province_id = $request->city;

		$user->save();
        return response()->json(['success'=>'Ajout avec succès']);
	}
	public function show($id)
    {
        $user = User::find($id);

		return view('users.show', ['user'=>$user]);
    }
	public function edit($id)
    {
        $user = User::find($id);

		return view('users.edit', ['user'=>$user]);
    }
	public function update(Request $request)
    {
        $user = User::find($request->id);
		$user->name = $request->name;
		$user->gender = $request->gender;
		$user->age = $request->age;
		$user->province_id = $request->city;

		$user->save();

        return response()->json(['success'=>'Modification enregistré avec succès']);
    }
	public function destroy(Request $request)
    {
    	User::destroy($request->id);

        return response()->json(['success'=>'Suppression avec succès']);
    }
    public function markSick(Request $request)
    {
    	$user = User::find($request->user_id);

    	$user->hascorona = 'oui';
    	$user->save();
    	return response()->json(['success'=>'User '.$user->name.' Marked Sik']);
    }
    public function uploadTwoMixers(Request $request)
    {
        if($request->person1 != $request->person2){
            //
            $user1 = User::find($request->person1);
            $user2 = User::find($request->person2);
            //
            if($user1->mixers){
                $links = explode(",", $user1->mixers);
                if(!in_array($request->person2, $links)){
                    $user1->mixers = $user1->mixers.','.$request->person2;
                    $user1->save();
                }
            }else{
                $user1->mixers = $request->person2;
                $user1->save();
            }
            if($user2->mixers){
                $links = explode(",", $user2->mixers);
                if(!in_array($request->person1, $links)){
                    $user2->mixers = $user2->mixers.','.$request->person1;
                    $user2->save();
                }
            }else{
                $user2->mixers = $request->person1;
                $user2->save();
            }
        }

        return response()->json(['success'=>'Contacted']);
    }
    //
    public function storeUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->province_id = $request->city;

        $user->save();
        return response()->json(['success'=>'Ajout avec succès', 'user'=>$user]);
    }
    public function uploadMixers(Request $request, $user_id)
    {
        $user = User::find($user_id);
        
        $user->mixers = $request->mixers;
        $user->save();

        return response()->json(['success'=>'User Mixed successfully']);
    }
    public function markAsSick(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $user->hascorona = 'oui';
        $user->save();
        return response()->json(['success'=>'User '.$user->name.' Marked Sick']);
    }
    public function mixUsers(Request $request, $person1, $person2)
    {
        if($person1 != $person2){
            //
            $user1 = User::find($person1);
            $user2 = User::find($person2);
            //
            if($user1->mixers){
                $links = explode(",", $user1->mixers);
                if(!in_array($person2, $links)){
                    $user1->mixers = $user1->mixers.','.$person2;
                    $user1->save();
                }
            }else{
                $user1->mixers = $person2;
                $user1->save();
            }
            if($user2->mixers){
                $links = explode(",", $user2->mixers);
                if(!in_array($person1, $links)){
                    $user2->mixers = $user2->mixers.','.$person1;
                    $user2->save();
                }
            }else{
                $user2->mixers = $person1;
                $user2->save();
            }
        }

        return response()->json(['success'=>'Contacted']);
    }
    public function fetchMixers(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if($user->mixers){
            $users = array();
            $mixers = explode(',',$user->mixers);
            foreach ($mixers as $mixer_id) {
                $users[] = User::find($mixer_id);
            }
            return response()->json(['success'=>'Fetched successfully', 'mixers'=>$users]);
        }else{
            return response()->json(['success'=>'User does not have mixers']);
        }
    }
    public function updateUser(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if($request->name)
            $user->name = $request->name;
        if($request->age)
            $user->age = $request->age;
        if($request->gender)
            $user->gender = $request->gender;
        if($request->hascorona)
            $user->hascorona = $request->hascorona;
        if($request->mixers)
            $user->mixers = $request->mixers;
        if($request->province_id)
            $user->province_id = $request->province_id;
        $user->save();

        return response()->json(['success'=>'Modifiè avec succès', 'user'=>$user]);
    }
}
