<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class apiAuthController extends Controller
{
    public function sendEmail(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'email' => 'required|email',
        'whatsapp' => 'required',
        'message' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }
    
        $body = $request->all();

        $result =  \Mail::send('send_satasme_mail_for_company', ['body' => $body], function ($message) use ($request) {
            $message->from('jayathilaka221b@gmail.com', 'SATASME.LK');
            $message->to($request->email, $request->name)->subject('Contact Reply');
        });
        
         $result2 =  \Mail::send('send_satasme_mail_for_ceo',['body' => $body] , function ($message) use ($request) {
            $message->from('jayathilaka221b@gmail.com', 'SATASME.LK');
            $message->to($request->email, $request->name)->subject('Contact Reply');
        });
        
        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "We sent you a mail, please check your mails."]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
        }
    }

    public function userLog(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = DB::table('users')
            ->where(DB::raw('lower(email)'), strtolower($email))
            ->first();
        $hashedPassword =  $user->password;
        $check = Hash::check($password, $hashedPassword);
            if ($check) {
                return response()->json(['stat' => 'ok','pass'=>$hashedPassword,'res'=>$check,'data'=>$password,'pass_enc'=>Hash::make($password)]);
             }else {
                return response()->json(['stat' => 'error','pass'=>$hashedPassword,'res'=>$check,'data'=>$password,'pass_enc'=>Hash::make($password)]);
            }
        
    }

    public function isUserExists(Request $request)
    {
        $email = $request->input('email');
        $exists = DB::table('users')
            ->where(DB::raw('lower(email)'), strtolower($email))
            ->exists();
        if ($exists) {
            return response()->json(['stat' => 'ok']);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|min:8|unique:users,name',
            'password' => ['required', 'max:20', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&_]/'],
        ]);

        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $id = DB::table('users')->insertGetId(
            [
                'email' => $email,
                'password' => Hash::make($password),
                'name' => $username,
                'cus_role_id' => 1,
                'is_free_package_active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => 1,
                'isAdmin' => 0,
            ]
        );
        if ($id) {
            return response()->json(['stat' => 'ok', 'id' => $id]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }
}
