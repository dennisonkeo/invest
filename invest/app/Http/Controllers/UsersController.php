<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Referral;
use App\Package;
use App\PackageUser;
use App\Deposit;
use App\Withdrawal;
use App\Message;
use Illuminate\Support\Facades\Hash;
use App\Notifications\HelloUser;
use App\Notifications\ResetPass;
use Auth;
use File;
use Mail;

class UsersController extends Controller
{
    public function index()
    {

    	$this->updateInterest();

    	
    	$country = Auth::user()->country;
    	$multiplier=0;

    	if($country == "Tanzania")
    	{
           $multiplier = 21.57;
    	}
    	elseif($country == "Uganda")
    	{
           $multiplier = 33.65;
    	}
    	elseif($country == "Rwanda")
    	{
           $multiplier = 9.31;
    	}
    	elseif($country == "Burundi")
    	{
           $multiplier = 18.13;
    	}
    	else
    	{
    		$multiplier = 1;
    	}

    	$referralEarning = Referral::where('referrer', Auth::user()->id)->sum('amount');
    	$withdrawn = Withdrawal::where('user_id', Auth::user()->id)->sum('amount');
    	$referrals = Referral::where('referrer', Auth::user()->id)->where('level', 1)->count();

       
       return view('user.index', compact('multiplier','referralEarning', 'withdrawn', 'referrals'));
    }

    public function homePage()
    {
      return view('home.index');
    }

    public function profile()
    {

      $user = Auth::user();

      return view('user.profile', compact('user'));
    }

    public function referral()
    {

      $user = Auth::user();

      return view('user.referral', compact('user'));
    }

    public function updateInterest()
    {
    	$userPackages = PackageUser::where('user_id', Auth::user()->id)->where('status', 1)->get();

    	foreach($userPackages as $package)
    	{
        $current_time = strtotime( date('Y-m-d H:i:s') );
        $last_update = strtotime( $package->last_update );
        $diff = $current_time - $last_update;
        $hours = (int)($diff / ( 60 * 60 ));

        $days = (int)($hours / 24);

        // $new_hours = $days * 24;
        $new_hours='+'.($days * 24).' hours';

        $new_date = date("Y-m-d H:i:s", strtotime($new_hours, $last_update));


        if($days >= 1)
        {
        	PackageUser::where('user_id', Auth::user()->id)
            ->where('package_id', $package->package_id)
            ->increment('day',$days);

            user::where('id', Auth::user()->id)
            ->increment('wallet',$package->amount);

            user::where('id', Auth::user()->id)
            ->increment('interest',$package->amount);

           PackageUser::where('user_id', Auth::user()->id)
            ->where('package_id', $package->package_id)
            ->update(array(
                'last_update' => $new_date
            ));
  
        }
 
    	}

    }    


    public function loginPage()
    {
    	return view('user.login');
    }

    public function register($username=null)
    {
    	return view('user.register', compact('username'));
    }

    public function login(Request $request)
    {
       $phone="";
	    $this->validate($request, [
	        'username' => 'required',
	        'password' => 'required',
	        ]);
	    if (Auth::attempt(['username' => $request->username,'password' => $request->password]) )
	    {
	    	if(Auth::user()->role == "user")
	    	{
	    		$phone = Auth::user()->phone;

	    		$this->updateInterest();

	    		return redirect('dashboard');
	    	}
	    	elseif(Auth::user()->role == "admin")
	    	{

	    		return redirect('admin-dashboard');
	    	}
	    	else
	    	{

	    	}
	        
	    }
	    return back()->with('warning', 'Incorrect Email address/Password');   
  }

   public function logout(Request $request)
	{
	    if(Auth::check())
	    {
	        Auth::logout();
	        $request->session()->invalidate();
	    }
	    return  redirect('login');
	}

  public function createUser(Request $request)
    {

    	if($request->country == "Kenya")
    	{
    		$this->validate($request, [
	        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	        'username' => ['required', 'string', 'max:255', 'unique:users'],
	        'name' => 'required',
	        'phone' => ['required', 'string', 'max:13','regex:/(07)[0-9]{8}/', 'unique:users'],
	        'password' => 'required',
	        ]);

    	}

    	 $this->validate($request, [
	        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	        'username' => ['required', 'string', 'max:255', 'unique:users'],
	        'name' => 'required',
	        'phone' => ['required', 'string', 'max:13', 'unique:users'],
	        'password' => 'required',
	        ]);

    	 $user_code = "";

    	 $verifyCode = User::where('username', $request->code)->first();

    	 if(!$verifyCode && $request->code != "")
    	 {
    	 	return back()->with('warning', 'Incorrect/invalid referral code!');
    	 }
    	 elseif($verifyCode)
    	 {
    	 	$user_code = $verifyCode->id;
    	 }

    	$user = new User;
        $phone=$request->phone;
        $user->name=$request->name;
        $user->country=$request->country;
        $user->phone=$request->phone;
        $user->date=date('Y-m-d');
        $user->username=$request->username;
        $user->email=$request->email;
        $user->refer=$user_code;
        $user->password=Hash::make($request->password);
        $user->save();

        if($request->code != "")
        {
           $refer = new Referral;
           $refer->user_id=$user->id;
           $refer->referrer=$user_code;
           $refer->level=1;
           $refer->save();

         if($user_code != "")
         {

           $findLevel2 = Referral::where('user_id', $user_code)->first();

          if($findLevel2)
          {
           $refer = new Referral;
           $refer->user_id=$user->id;
           $refer->referrer=$findLevel2->referrer;
           $refer->level=2;
           $refer->save();
          }
      }



          $findLevel3 = Referral::where('user_id', $findLevel2['referrer'])->first();

          if($findLevel3)
          {
           $refer = new Referral;
           $refer->user_id=$user->id;
           $refer->referrer=$findLevel3->referrer;
           $refer->level=3;
           $refer->save();
          }

          $findLevel4 = Referral::where('user_id', $findLevel3['referrer'])->first();

          if($findLevel4)
          {
           $refer = new Referral;
           $refer->user_id=$user->id;
           $refer->referrer=$findLevel4->referrer;
           $refer->level=4;
           $refer->save();
          }

        }

        return redirect('/');

    }

    public function packages()
    {
    	
    	$packages = Package::all();
       
       return view('admin.addPackage', compact('packages'));
    }

    public function userPackages()
    {
    	
    	$packages = Package::all();
       
       return view('user.packages', compact('packages'));
    }

    public function deposits()
    {
    	$deposits = Deposit::where('user_id', Auth::user()->id)->get();
       
       return view('user.deposit', compact('deposits'));
    }

    public function withdrawals()
    {
    	$withdrawals = Withdrawal::where('user_id', Auth::user()->id)->get();
       
       return view('user.withdrawal', compact('withdrawals'));
    }

    public function investments()
    {
    	$investments = PackageUser::where('user_id', Auth::user()->id)->get();
       
       return view('user.investment', compact('investments'));
    }

    public function referrals()
    {
    	$referrals = Referral::where('referrer', Auth::user()->id)->get();
       
       return view('user.referrals', compact('referrals'));
    }

    public function addPackages(Request $request)
    {
       
           $package = new Package;
           $package->name=$request->name;
           $package->amount=$request->amount;
           $package->details=$request->details;

           $package->save();

           return back()->with('success', 'Package created successfully!');
    }

    public function packageSub(Request $request)
    {
        $subscribed = PackageUser::where('user_id', Auth::user()->id)->where('package_id', $request->id)->first();
        $packageAmount = Package::where('id', $request->id)->first();

        $bonus = 0.1 * $packageAmount->amount;
        $referralEarning1 = 0.08 * $packageAmount->amount;
        $referralEarning2 = 0.02 * $packageAmount->amount;

        if($subscribed)
        {
        	return response()->json(["msg"=>1]);
        }

        if($request->method == "grand")
        {
        	if(Auth::user()->wallet < $packageAmount->amount)
        	{
        		return response()->json(["msg"=>2]);
        	}

           $package = new PackageUser;
           $package->user_id=Auth::user()->id;
           $package->amount=$bonus;
           $package->package_id=$request->id;
           $package->start_date=date('Y-m-d H:i:s');
           $package->last_update=date('Y-m-d H:i:s');

           $package->save();

           user::where('id', Auth::user()->id)
            ->decrement('wallet',$packageAmount->amount);

            // referral earning

         $users = Referral::where('user_id', Auth::user()->id)->get();

         if($users)
         {

	     foreach($users as $user)
	    {
		if($user->level == 1)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',$referralEarning1);

            Referral::where('user_id', Auth::user()->id)
            ->where('level', 1)
            ->update(array(
                'amount' => $referralEarning1
            ));

            $userEmail = User::where('id', $user->referrer)->first();
            $referredName = User::where('id', Auth::user()->id)->first();
            
            $amount = $referralEarning1;
            $name = $referredName->name;
            $direct = 'Directly';

            $userEmail->notify(new HelloUser($amount,$name,$direct));
		}

		if($user->level == 2)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',$referralEarning2);

            Referral::where('user_id', Auth::user()->id)
            ->where('level', 2)
            ->update(array(
                'amount' => $referralEarning2
            ));

            $userEmail = User::where('id', $user->referrer)->first();
            $referredName = User::where('id', Auth::user()->id)->first();
            
            $amount = $referralEarning2;
            $name = $referredName->name;
            $direct = 'Indirectly';
		}

		if($user->level == 3)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',0);
		}
		if($user->level == 4)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',0);
		}

		
	  }
     }

           return response()->json(["msg"=>0]);
        }
        else
        {
        	if(Auth::user()->deposit < $packageAmount->amount)
        	{
        		return response()->json(["msg"=>2]);
        	}

           $package = new PackageUser;
           $package->user_id=Auth::user()->id;
           $package->amount=$bonus;
           $package->package_id=$request->id;
           $package->start_date=date('Y-m-d H:i:s');
           $package->last_update=date('Y-m-d H:i:s'); 

           $package->save();

           user::where('id', Auth::user()->id)
            ->decrement('deposit',$packageAmount->amount);

                     // referral earning

         $users = Referral::where('user_id', Auth::user()->id)->get();

         if($users)
         {

	     foreach($users as $user)
	    {
		if($user->level == 1)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',$referralEarning1);

            Referral::where('user_id', Auth::user()->id)
            ->where('level', 1)
            ->update(array(
                'amount' => $referralEarning1
            ));

            $userEmail = User::where('id', $user->referrer)->first();
            $referredName = User::where('id', Auth::user()->id)->first();
            
            $amount = $referralEarning1;
            $name = $referredName->name;
            $direct = 'Directly';

            $userEmail->notify(new HelloUser($amount,$name,$direct));
		}

		if($user->level == 2)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',$referralEarning2);

            Referral::where('user_id', Auth::user()->id)
            ->where('level', 2)
            ->update(array(
                'amount' => $referralEarning2
            ));

            $userEmail = User::where('id', $user->referrer)->first();
            $referredName = User::where('id', Auth::user()->id)->first();
            
            $amount = $referralEarning2;
            $name = $referredName->name;
            $direct = 'Indirectly';

            $userEmail->notify(new HelloUser($amount,$name,$direct));
		}

		if($user->level == 3)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',0);
		}
		if($user->level == 4)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',0);
		}

		
	  }
     }

           return response()->json(["msg"=>0]);
        }
           
    }


public function mpesaDeposit(Request $request)

{


$amount = $request->amount;
$ptn = "/^0/"; 
$phone_number = $request->phone; 
$phone = preg_replace($ptn, "254", $phone_number);

$consumerKey = 'GFlGTOPUjq5xtyt4Md6DUa457Ukb9CdO';
$consumerSecret = 'grVYIMkqSN10Zjdj';
$url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
$credentials = base64_encode($consumerKey.':'.$consumerSecret);

curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials));
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$curl_response = curl_exec($curl);
$feedback =  json_decode($curl_response);
$access_token = $feedback->access_token;
curl_close($curl);

if(is_null($access_token) == false){
$initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$AccountReference = 'AAG';
$TransactionDesc = 'Payment for goods via M-PESA.';

  $BusinessShortCode =   '7481101';  //'7340885'; //
  $Timestamp = date('YmdHis');
  $PassKey = '79e312dcde48aa377d3fd5dade74a51141d4c5d58d1cebe54a0ad9b4370b4b5c';
  $Password = base64_encode($BusinessShortCode.$PassKey.$Timestamp);
  $Amounggt = '1';
  
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $initiate_url);
$stkHeader =  ['Content-Type:application/json','Authorization:Bearer '.$access_token];
curl_setopt($ch, CURLOPT_HTTPHEADER, $stkHeader);

$curl_post_data = array(
  'BusinessShortCode' => $BusinessShortCode,
  'Password' => $Password,
  'Timestamp' => $Timestamp,
  'TransactionType' => 'CustomerBuyGoodsOnline',
  'Amount' => $amount, 
  'PartyA' => $phone,
  'PartyB' => '5483281',
  'PhoneNumber' =>$phone,
  'CallBackURL' => 'https://heavy-penguin-66.loca.lt/api/mpesa-response',
  'AccountReference' => $AccountReference,
  'TransactionDesc' => $TransactionDesc
);
$data_string = json_encode($curl_post_data);
$ch = curl_init($initiate_url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $stkHeader);
$result = curl_exec($ch);
curl_close($ch);

// $callbackJSONData=file_get_contents('php://input');

        // $handle=fopen("transaction.txt", 'w');

        // fwrite($handle, json_decode($result)->MerchantRequestID);
user::where('id', Auth::user()->id)
            ->update(array(
                'mpesaId' => json_decode($result)->MerchantRequestID
            ));

return response()->json(["msg"=>$result]);

  }
}

public function mpesa_response(Request $request)
{
	// dd(Auth::user());
        // $callbackJSONData=File::get('transactions.txt');
        $callbackJSONData=file_get_contents('php://input');

        $handle=fopen("transactions.txt", 'w');

        fwrite($handle, $callbackJSONData);

        $account_no = json_decode($callbackJSONData)->Body->stkCallback->MerchantRequestID;

        $ResultCode = json_decode($callbackJSONData)->Body->stkCallback->ResultCode;

        $CheckoutRequestIDVariable = json_decode($callbackJSONData)->Body->stkCallback->CheckoutRequestID;
        $ResultDescVariable = json_decode($callbackJSONData)->Body->stkCallback->ResultDesc;
        $amount = json_decode($callbackJSONData)->Body->stkCallback->CallbackMetadata->Item[0]->Value;
	    $phone = json_decode($callbackJSONData)->Body->stkCallback->CallbackMetadata->Item[4]->Value;
	    $trans_no = json_decode($callbackJSONData)->Body->stkCallback->CallbackMetadata->Item[1]->Value;
	    $trans_date = json_decode($callbackJSONData)->Body->stkCallback->CallbackMetadata->Item[3]->Value;

        date_default_timezone_set('Africa/Nairobi');
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $finaltime = $date.' at '. $time;

        $user = User::where('mpesaId', $account_no)->first();

        // $ResultCode = "0";
        $user_id = $user->id;

        if($ResultCode == "0")

        {

	    //save mpesa transaction
	    $payment = new Deposit;
        $payment->MerchantRequestID=$account_no;
        $payment->CheckoutRequestID=$CheckoutRequestIDVariable;
        $payment->response_code=$ResultCode;
        $payment->response_message=$ResultDescVariable;
        $payment->time=$finaltime;
        $payment->phone=$phone;
        $payment->amount=$amount;
        $payment->user_id=$user_id;
        $payment->transaction_code=$trans_no;

        $payment->save();

	user::where('id', $user_id)
            ->increment('deposit',$amount);

	// return response()->json(["msg"=>"success"]);

        }


    }

    public function transferFunds(Request $request)
    {
    	if(Auth::user()->wallet < $request->amount)
    	{
          return response()->json(["msg"=>1]);
    	}
    	else
    	{

    	 user::where('id', Auth::user()->id)
            ->decrement('wallet',$request->amount);

         user::where('id', Auth::user()->id)
            ->increment('deposit',$request->amount);

          return response()->json(["msg"=>0]);
    	}
    	
    }

    public function withdrawFunds(Request $request)
    {
    	if($request->amount < 500)
    	{
    		return response()->json(["msg"=>2]);
    	}
    	elseif(Auth::user()->wallet < $request->amount)
    	{
          return response()->json(["msg"=>1]);
    	}

    	else
    	{

    	 user::where('id', Auth::user()->id)
            ->decrement('wallet',$request->amount);

        $Withdrawal = new Withdrawal;
        $Withdrawal->user_id = Auth::user()->id;
        $Withdrawal->amount = $request->amount;
        $Withdrawal->date = date('Y-m-d H:i:s');

        $Withdrawal->save();

          return response()->json(["msg"=>0]);
    	}
    	
    }


    public function resetPass()
  {
      return view('user.forgot-Password');
  }
  
  public function sendPass(Request $request)
  {
      $user = User::where('email', $request->email)->first();
   
      if(!$user)
      {
          return back()->with('warning', 'Email address does not exist');
      }
        $pass = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $password = Hash::make($pass);

		user::where('email', $request->email)
            ->update(array(
                'password' => $password
            ));
            
            $user->notify(new ResetPass($pass));

         return back()->with('success', 'Password has been sent to your email address!');
  }

  public function inbox()
  {
    $role = Auth::user()->role;

    if($role == "admin")
    {
      $messages = Message::where('receiver', 'admin')->orderBy('id', 'desc')->get();

      $unread = Message::where('receiver', 'admin')->where('msg_read', 0)->count();

      return view('user.inbox', compact('messages', 'role', 'unread'));
    }
    else
    {
        $msgs = Message::where('receiver_id', Auth::user()->id)->get();

        $unread = Message::where('receiver_id', Auth::user()->id)->where('msg_read', 0)->count();

        return view('user.inbox', compact('msgs', 'role', 'unread'));
    }

    
  }


  public function outBox()
  {
    $role = Auth::user()->role;

    if($role == "admin")
    {
      $messages = Message::where('receiver', 'user')->orderBy('id', 'desc')->get();

      $unread = Message::where('receiver', 'admin')->where('msg_read', 0)->count();

      return view('user.outbox', compact('messages', 'role', 'unread'));
    }
    else
    {
        $msgs = Message::where('user_id', Auth::user()->id)->where('receiver', 'admin')->get();

        $unread = Message::where('receiver_id', Auth::user()->id)->where('msg_read', 0)->count();

        return view('user.outbox', compact('msgs', 'role', 'unread'));
    }

    
  }

  public function sendMsg(Request $request)
  {
     $receiver = User::where('username', $request->username)->first();

     if(!$receiver && Auth::user()->role == "admin")
     {
        return back()->with('warning', 'The user does not exist!');
     }
     elseif(Auth::user()->role == "admin")
     {
        $msg = new Message;
        $msg->user_id = Auth::user()->id;
        $msg->receiver_id = $receiver->id;
        $msg->subject = $request->subject;
        $msg->date = date('Y-m-d');
        $msg->time = date('H:i:s');
        $msg->msg = $request->msg;

        $msg->save();
     }
     else
     {
        $msg = new Message;
        $msg->user_id = Auth::user()->id;
        $msg->subject = $request->subject;
        $msg->date = date('Y-m-d');
        $msg->time = date('H:i:s');
        $msg->msg = $request->msg;
        $msg->receiver = "admin";

        $msg->save();
     }
        

      return back()->with('success', 'Message sent!');
  }

  public function readMsg($id)
  {
    $role = Auth::user()->role;

    if(Auth::user()->role == "admin")
    {

       Message::where('id', $id)
            ->update(array(
                'msg_read' => 1
            ));


      $unread = Message::where('receiver', 'admin')->where('msg_read', 0)->count();

      $msg = Message::where('id', $id)->first();

   
    return view('user.readMsg', compact('msg', 'unread', 'role'));
    }
    else
    {

      Message::where('id', $id)
            ->update(array(
                'msg_read' => 1
            ));

      $unread = Message::where('receiver_id', Auth::user()->id)->where('msg_read', 0)->count();

      $msg = Message::where('id', $id)->where('receiver_id', Auth::user()->id)->firstOrFail();
   

    return view('user.readMsg', compact('msg', 'unread', 'role'));
    }
    
  }

  public function readSentMsg($id)
  {
    $role = Auth::user()->role;

    if(Auth::user()->role == "admin")
    {

       Message::where('id', $id)
            ->update(array(
                'msg_read' => 1
            ));


      $unread = Message::where('receiver', 'admin')->where('msg_read', 0)->count();

      $msg = Message::where('id', $id)->first();

   
    return view('user.readMsg', compact('msg', 'unread', 'role'));
    }
    else
    {

      Message::where('id', $id)
            ->update(array(
                'msg_read' => 1
            ));

      $unread = Message::where('receiver_id', Auth::user()->id)->where('msg_read', 0)->count();

      $msg = Message::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
   

    return view('user.readMsg', compact('msg', 'unread', 'role'));
    }
    
  }
}
