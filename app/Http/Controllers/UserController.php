<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function saveUser(Request $request){
        
        if($request->UserID == ""){
            $user = new User();
            $user->name = $request->UserName;
            $user->email = $request->UserEmail;
            $user->idnum = $request->UserUName;
            $user->password = Hash::make($request->UserPassword);
            $user->role = $request->UserRole;
            $user->status = $request->UserStatus;
                $dirtyAttributes = $user->getDirty();
            $user->save();
            
                foreach($dirtyAttributes as $attribute => $newValue){
                    $oldValue = $user->getOriginal($attribute);
        
                    $field = ucwords(str_replace('_', ' ', $attribute));

                    $newLog = new ActivityLog();
                    $newLog->table = 'UserTable';
                    $newLog->table_key = $user->id;
                    $newLog->action = 'ADD';
                    $newLog->description = $user->name;
                    $newLog->field = $field;
                    $newLog->before = $oldValue;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress =  request()->ip();
                    $newLog->save();
                }

            return response()->json(['message' => 'New record added']);
        }else{
            $user = User::find($request->UserID);
            $user->name = $request->UserName;
            $user->email = $request->UserEmail;
            $user->idnum = $request->UserUName;
                if (!empty($request->UserPassword)) {
                    $user->password = Hash::make($request->UserPassword);
                }
            $user->role = $request->UserRole;
            $user->status = $request->UserStatus;
            
                $dirtyAttributes = $user->getDirty();
            
                foreach($dirtyAttributes as $attribute => $newValue){
                    $oldValue = $user->getOriginal($attribute);
        
                    $field = ucwords(str_replace('_', ' ', $attribute));

                    $newLog = new ActivityLog();
                    $newLog->table = 'UserTable';
                    $newLog->table_key = $request->UserID;
                    $newLog->action = 'UPDATE';
                    $newLog->description = $user->name;
                    $newLog->field = $field;
                    $newLog->before = $oldValue;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress =  request()->ip();
                    $newLog->save();
                }

            $user->update();
            return response()->json(['message' => 'Record updated']);
        }
    }

    public function viewUser(Request $request){
        $user = DB::table('pms_users')->where('id',$request->id)->first();

        $result = array(
            'UserID' => $user->id, 
            'UserFName' => $user->name, 
            'UserEmail' => $user->email, 
            'UserUName' => $user->idnum, 
            'UserRole' => $user->role, 
            'UserStatus' => $user->status,
        );
        
        return json_encode($result);
    }
}
