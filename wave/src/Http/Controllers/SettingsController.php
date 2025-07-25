<?php

namespace Wave\Http\Controllers;

use Filament\Forms\Components\KeyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Wave\ApiKey;
use Wave\ProfileKeyValue;

class SettingsController extends \App\Http\Controllers\Controller
{
    public function index($section = ''){
        if(empty($section)){
            return redirect(route('wave.settings', 'profile'));
        }
        return view('theme::settings.index', compact('section'));
    }

    public function profilePut(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . Auth::user()->id,
            'username' => 'sometimes|required|unique:users,username,' . Auth::user()->id,
            'avatar' => 'nullable|base64image'
        ],
        [
            'avatar.base64image' => 'The avatar must be a valid image.'
        ]);

        $authed_user = auth()->user();

        $authed_user->name = $request->name;
        $authed_user->email = $request->email;
        if($request->avatar){
           $authed_user->avatar = $this->saveAvatar($request->avatar, $authed_user->username);
        }
        $authed_user->save();

        foreach(config('wave.profile_fields') as $key){
            if(isset($request->{$key})){
                $type = $key . '_type__keyvalue';
                if($request->{$type} == 'checkbox'){
                    if(!isset($request->{$key})){
                        $request->request->add([$key => null]);
                    }
                }

                $row = (object)['field' => $key, 'type' => $request->{$type}, 'details' => ''];
                $value = $this->getContentBasedOnType($request, 'themes', $row);

                if(!is_null($authed_user->keyValue($key))){
                    $keyValue = KeyValue::where('keyvalue_id', '=', $authed_user->id)->where('keyvalue_type', '=', 'users')->where('key', '=', $key)->first();
                    $keyValue->value = $value;
                    $keyValue->type = $request->{$type};
                    $keyValue->save();
                } else {
                    KeyValue::create(['type' => $request->{$type}, 'keyvalue_id' => $authed_user->id, 'keyvalue_type' => 'users', 'key' => $key, 'value' => $value]);
                }
            } else {
                if(!is_null($authed_user->keyValue($key))){
                    $keyValue = KeyValue::where('keyvalue_id', '=', $authed_user->id)->where('keyvalue_type', '=', 'users')->where('key', '=', $key)->first();
                    $keyValue->delete();
                }
            }
        }

        return back()->with(['message' => 'Successfully updated user profile', 'message_type' => 'success']);
    }

    public function securityPut(Request $request){

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:'.config('wave.auth.min_password_length'),
        ]);

        if ($validator->fails()) {
            return back()->with(['message' => $validator->errors()->first(), 'message_type' => 'danger']);
        }

        auth()->user()->forceFill([
            'password' => bcrypt($request->password)
        ])->save();

        return back()->with(['message' => 'Successfully updated your password.', 'message_type' => 'success']);
    }

    public function paymentPost(Request $request){
        $subscribed = auth()->user()->updateCard($request->paymentMethod);
    }

    public function apiPost(Request $request){
        $request->validate([
            'key_name' => 'required'
        ]);

        $apiKey = auth()->user()->createApiKey(Str::slug($request->key_name));
        if(isset($apiKey->id)){
            return back()->with(['message' => 'Successfully created new API Key', 'message_type' => 'success']);
        } else {
            return back()->with(['message' => 'Error Creating API Key, please make sure you entered a valid name.', 'message_type' => 'danger']);
        }
    }

    public function apiPut(Request $request, $id = null){
        if(is_null($id)){
            $id = $request->id;
        }
        $apiKey = ApiKey::findOrFail($id);
        if($apiKey->user_id != auth()->user()->id){
            return back()->with(['message' => 'Canot update key name. Invalid User', 'message_type' => 'danger']);
        }
        $apiKey->name = Str::slug($request->key_name);
        $apiKey->save();
        return back()->with(['message' => 'Successfully update API Key name.', 'message_type' => 'success']);
    }

    public function apiDelete(Request $request, $id = null){
        if(is_null($id)){
            $id = $request->id;
        }
        $apiKey = ApiKey::findOrFail($id);
        if($apiKey->user_id != auth()->user()->id){
            return back()->with(['message' => 'Canot delete Key. Invalid User', 'message_type' => 'danger']);
        }
        $apiKey->delete();
        return back()->with(['message' => 'Successfully Deleted API Key', 'message_type' => 'success']);
    }

    
}
