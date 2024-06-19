<?php
// namespace App\Http\Controllers;
// use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Mail;
// use App\Models\User;
// use Illuminate\Support\Str;
// use Symfony\Component\HttpFoundation\Session\Session;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;




// class MailController extends Controller{
//     function forgetpassword(){

//         return view('user.forgetpassword');
//     }
//     function send_passreset_token(Request $request){
//         $data = $request->all();

//         $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
//         $title = 'Lấy lại mật khẩu / Password retrieval';
        
//         $user_email = User::where('email','=',$data['gmail'])->get();
//         foreach($user_email as $key => $value){
//             $user_id = $value->id;
//         }
//         if($user_email){
//             $user_count = $user_email->count();
//             if($user_count==0)
//                 return redirect()->back()->with('error','Do not have Email');    
        
//             else{
//                 echo $token_random = Str::random(191);
//                 $user = User::find($user_id);
//                 $user_email->reset_token = $token_random;
//                 $user_email->save();

//                 //send email
//                 $to_email = $data['gmail'];
//                 $link_reset_pass = url('/update-new-pass?email='.$to_email.'$token'.$token_random);
//                 $data = array("name"=>$title,"body"=>$link_reset_pass,'email'=>$data['gmail']);
//                 Mail::send('view.user.forget_notify',['data'=>$data],function($message) use ($title,$data){
//                     $message->to($data['email'])->subject($title);
//                     $message->from($data['email'],$title);


//                 });


//             }
//         }
//     }   
        
    


        


// }

// <?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function forgetpassword()
    {
        return view('user.forgetpassword');
    }

    public function send_passreset_token(Request $request)
    {
        $data = $request->validate([
            'gmail' => 'required|email'
        ]);

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title = 'Lấy lại mật khẩu / Password retrieval';
        
        $user = User::where('email', $data['gmail'])->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email does not exist.');
        }

        $token_random = Str::random(191);
        $user->reset_token = $token_random;
        $user->save();

        // Send email
        $to_email = $data['gmail'];
        $link_reset_pass = url('/update-new-pass?email=' . $to_email . '&token=' . $token_random);
        $mail_data = [
            "name" => $title,
            "body" => $link_reset_pass,
            'email' => $to_email
        ];

        Mail::send('user.forget_notify', ['data' => $mail_data], function ($message) use ($title, $mail_data) {
            $message->to($mail_data['email'])->subject($title);
            $message->from('no-reply@yourdomain.com', 'Your Application Name');
        });

        return redirect()->back()->with('success', 'Password reset link has been sent to your email.');
    }
}





