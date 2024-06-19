<?php



// namespace App\Http\Controllers;

// use App\Models\Orders;
// use App\Models\User;
// use Carbon\Carbon;
// use Gloudemans\Shoppingcart\Facades\Cart;
// use Illuminate\Http\Request;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Auth;

// class MailController extends Controller
// {
//     public function forgetpassword()
//     {
//         return view('user.forgetpassword');
//     }

//     public function send_passreset_token(Request $request)
//     {
//         $data = $request->all();
//         // print_r($data);

//         $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
//         $title = 'Lấy lại mật khẩu / Password retrieval';
        
//         $user = User::where('email','=', $data['gmail'])->get();
//         print_r($data['gmail']);
//         foreach($user as $key => $value){
//             $user_id = $value->id;
//         }
//         if($user){
//             $count = $user->count();
//             print_r($count);
//             if ($count==0) {
//                 return redirect()->back()->with('error', 'Email does not exist.');
//             }
//             else{
//                 $token_random = Str::random(191);
//                 $user = User::find($user_id);
//                 $user->reset_token = $token_random;
//                 $user->save();

//                 // Send email
//                 $to_email = $data['gmail'];
//                 $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
//                 $mail_data = [
//                     "name" => $title,
//                     "body" => $link_reset_pass,
//                     'email' => $to_email
//                 ];

//                 Mail::send('user.forget_notify', ['data' => $mail_data], function ($message) use ($title, $mail_data) {
//                     $message->to($mail_data['email'])->subject($title);
//                     $message->from('no-reply@yourdomain.com', 'Your Application Name');
//                     });
//                 }
//             return redirect()->back()->with('success', 'Password reset link has been sent to your email.');
//             }
//     }

//     // public function send_email_order($mail_data,$title){

//     //     Mail::send('/your_order', ['data' => $mail_data], function ($message) use ($title, $mail_data) {
//     //         $message->to($mail_data['email'])->subject($title);
//     //         $message->from('no-reply@yourdomain.com', 'Your Application Name');
//     //         });
        
//     // }
//     public function update_new_pass(){
//         return view('user.update_new_pass');
//     }

//     public function solve_update_new_pass(Request $request){
//         $data = $request->all();
//         $gmail=$data['gmail'];
//         $token=$data['token'];
//         $token_random = Str::random(191);
//         $password = $data['newpass'];
//         $user = User::where('email','=',$gmail)->where('reset_token','=',$token)->get();
//         $count = $user->count();
//         if($count==1){

//             foreach($user as $key => $value){
//                 $user_id = $value->id;

//             }
//             $reset = User::find($user_id);
//             $reset->password = bcrypt($password);
//             $reset->reset_token = $token_random;
//             $reset->save();
//             return redirect('/login')->with("success",'Update successful !');
//         }
//         else{
//             return redirect('/forgetpassword')->with("error",'Request Timeout! gmail:'.$gmail.'check'.$count.'token:'.$token);
//         }


//     }

//     public function give_mail_your_order($id){
        
//         if(Auth::check()){
//             $orders_id = $id;
//             // session()->forget('orders_id_use');
//             Cart::destroy();
//             $content = Orders::find($orders_id);
//             // if($content==null){
//             //     $maxOrderId = Orders::max('id');
//             //     $content = Orders::find($maxOrderId);
//             // }
//             $gmail= $content['email'];
//             if($gmail==null){
//                 $gmail='hagiabao980@gmail.com';
//             }
//             $phone=$content['phone'];
//             $title = 'Đơn hàng của khách hàng có số điện thoại '.$phone;
            

//             // Send email
//             $to_email = $gmail;
//             $link_order = url('/your_orders_detail/'.$id);
//             $mail_data = [
//                 "name" => $title,
//                 "body" => $link_order,
//                 'email' => $to_email
//             ];

//             Mail::send('user.order_mail', ['data' => $mail_data], function ($message) use ($title, $mail_data) {
//                 $message->to($mail_data['email'])->subject($title);
//                 $message->from('no-reply@yourdomain.com', 'Your Application Name');
//                 });
//         return redirect('/your_orders_detail/'.$id)->with('thongbao', 'Successfully và đã gửi thông tin đến gmail');
//         }
//         else{

//             $orders_id = $id;
//             // session()->forget('orders_id_use');
//             Cart::destroy();
//             $content = Orders::find($orders_id);
//             // if($content==null){
//             //     $maxOrderId = Orders::max('id');
//             //     $content = Orders::find($maxOrderId);
//             // }
//             $gmail= $content['email'];
//             if($gmail==null){
//                 $gmail='hagiabao980@gmail.com';
//             }
//             $phone=$content['phone'];
//             $title = 'Đơn hàng của khách hàng có số điện thoại '.$phone;
            

//             // Send email
//             $to_email = $gmail;
//             $link_order = url('/your_orders_detail/'.$id);
//             $mail_data = [
//                 "name" => $title,
//                 "body" => $link_order,
//                 'email' => $to_email
//             ];

//             Mail::send('user.order_mail', ['data' => $mail_data], function ($message) use ($title, $mail_data) {
//                 $message->to($mail_data['email'])->subject($title);
//                 $message->from('no-reply@yourdomain.com', 'Your Application Name');
//                 });
//         return redirect('/your_orders_detail/'.$id)->with('thongbao', 'Successfully và đã gửi thông tin đến gmail'.$id);
        
//     }
//     }
// }

    





