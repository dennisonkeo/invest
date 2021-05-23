<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\PaymentMethod;
use App\Referral;
use App\Transaction;
use App\Payment;
use App\SpinAward;
use App\Blog;
use App\Survey;
use App\SurveyQuiz;
use App\QuizOp;
use App\Video;
use App\SurveyEarning;
use Illuminate\Support\Str;
class UserController extends Controller
{
    
    public function __construct()
{
   // $this->middleware('activeUsers');
   
}



    public function index()
    {
    	$referals = Referral::where('referrer', Auth::user()->id)->where('level', 1)->get();

    	$spinEarnings = SpinAward::where('user_id', Auth::user()->id)->sum('amount');

    	$withdrawals = Transaction::where('user_id', Auth::user()->id)->sum('amount');

    	$survey = SurveyEarning::where('user_id', Auth::user()->id)->sum('amount');

    	 $blogEarnings = Blog::where('user_id', Auth::user()->id)->sum('amount');

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


    	return view('admin.dashboard', compact('referals', 'spinEarnings', 'withdrawals', 'survey', 'multiplier', 'blogEarnings'));
    }

    public function loginPage()
    {
    	return view('admin.login');
    }

    public function register($username=null)
    {
    	return view('admin.register', compact('username'));
    }

    public function login(Request $request)
    {
       $phone="";
	    $this->validate($request, [
	        'email' => 'required|email',
	        'password' => 'required',
	        ]);
	    if (Auth::attempt(['email' => $request->email,'password' => $request->password]) )
	    {
	    	if(Auth::user()->status == "active")
	    	{
	    		$phone = Auth::user()->phone_number;

	    		return redirect('/');
	    	}
	    	elseif(Auth::user()->role == "admin")
	    	{

	    		return redirect('admin-dashboard');
	    	}
	    	else
	    	{
	    		// if(Auth::check())
	      //       {
	      //        Auth::logout();
	      //        $request->session()->invalidate();
	      //       }
	    		return redirect('/payment')->with( [ 'phone' => $phone ] );
	    	}
	        
	    }
	    return back()->with('warning', 'Incorrect Email address/Password');   
  }

  public function createUser(Request $request)
    {

    	if($request->country == "Kenya")
    	{
    		$this->validate($request, [
	        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	        'username' => ['required', 'string', 'max:255', 'unique:users'],
	        'name' => 'required',
	        'phone_number' => ['required', 'string', 'max:13','regex:/(07)[0-9]{8}/', 'unique:users'],
	        'password' => 'required',
	        ]);

    	}

    	 $this->validate($request, [
	        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	        'username' => ['required', 'string', 'max:255', 'unique:users'],
	        'name' => 'required',
	        'phone_number' => ['required', 'string', 'max:13', 'unique:users'],
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
        $phone=$request->phone_number;
        $user->name=$request->name;
        $user->country=$request->country;
        $user->phone_number=$request->phone_number;
        $user->date=date('Y-m-d');
        $user->status="inactive";
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

        return redirect('payment')->with( [ 'phone' => $phone ] );

    }

    public function paymentform()
    {
    	return view('admin.payment');
    }

 public function mpesaPayment(Request $request)
{


$amount = $request->amount;
$ptn = "/^0/"; 
$phone_number = Auth::user()->phone_number; 
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
  'Amount' => "1", 
  'PartyA' => $phone,
  'PartyB' => '5483281',
  'PhoneNumber' =>$phone,
  'CallBackURL' => 'http://attention.timespay.co.ke/api/mpesa-response',
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
          $users = Referral::where('user_id',$user_id)->get();

	     foreach($users as $user)
	    {
		if($user->level == 1)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',300);
		}

		if($user->level == 2)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',100);
		}

		if($user->level == 3)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',50);
		}
		if($user->level == 4)
		{
			user::where('id', $user->referrer)
            ->increment('wallet',20);
		}

		
	}

	//save mpesa transaction
	    $payment = new Payment;
        $payment->MerchantRequestID=$account_no;
        $payment->CheckoutRequestID=$CheckoutRequestIDVariable;
        $payment->response_code=$ResultCode;
        $payment->response_message=$ResultDescVariable;
        $payment->time=$finaltime;
        $payment->phone=$phone;
        $payment->amount=$amount;
        $payment->transaction_code=$trans_no;

        $payment->save();

	user::where('id', $user_id)
            ->update(array(
                'status' => "active"
            ));

	// return response()->json(["msg"=>"success"]);

        }


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


	public function withdrawalPage()
	{
		$transactions = Transaction::where('user_id', Auth::user()->id)->get();
		

		return view('admin.withdrawals', compact('transactions'));
	}

	public function withdrawToMpesa(Request $request)
	{
		$verifyAmount = User::where('id', Auth::user()->id)->first();

    	 if($verifyAmount && $verifyAmount->wallet < $request->amount)
    	 {
    	 	return back()->with('warning', 'The amount entered exceeds your wallet balance!');
    	 }
		$transaction = new Transaction;
        $transaction->user_id=Auth::user()->id;
        $transaction->amount=$request->amount;
        $transaction->status="Pending";
        $transaction->pay_method="Mpesa";
        $transaction->date=date('Y-m-d');

        $transaction->save();

        user::where('id', Auth::user()->id)
            ->decrement('wallet',$request->amount);

        return back()->with('success', 'Withdrawal request posted successfully'); 
	}

	public function referralPage()
	{
		$count = 1;

		$level1 = Referral::where('referrer',Auth::user()->id)->where('level', 1)->get();
		$level2 = Referral::where('referrer',Auth::user()->id)->where('level', 2)->get();
		$level3 = Referral::where('referrer',Auth::user()->id)->where('level', 3)->get();
		$level4 = Referral::where('referrer',Auth::user()->id)->where('level', 4)->get();

		return view('admin.referrals', compact('level1','level2','level3', 'level4', 'count'));
	}

	public function profilePage()
	{
		$user = Auth::user();

		$paymethods = PaymentMethod::all();

		return view('admin.profile', compact('user','paymethods'));
	}

	public function spinPage()
	{
		

		return view('admin.spinner');
	}

	public function spinWin(Request $request)
	{
		$checkSpin = SpinAward::where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->first();

		if($checkSpin)
		{
			return response()->json(["msg"=>"error"]);
		}

		user::where('id', Auth::user()->id)
            ->increment('wallet',$request->amount);

        $spin = new SpinAward;
        $spin->user_id=Auth::user()->id;
        $spin->amount=$request->amount;
        $spin->date=date('Y-m-d');

        $spin->save();

        return response()->json(["msg"=>"success"]);
	}

	public function blogsPage()
	{
		
        $blogs = Blog::where('user_id', Auth::user()->id)->get();

		return view('admin.blog', compact('blogs', 'earnings'));
	}

	public function blogPost(Request $request)
	{
		date_default_timezone_set('Africa/Nairobi');

		$checkBlog = Blog::where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->first();

		if($checkBlog)
		{
			return back()->with('warning', 'Your blog post limit has been reached. Try again tomorrow!');   
		}

        $blog = new Blog;
        $blog->user_id=Auth::user()->id;
        $blog->title=$request->title;
        $blog->content=$request->content;
        $blog->date=date('Y-m-d');

        $blog->save();

        return back()->with('success', 'Blog post submited successfully');   
	}

	public function surveyPage()
	{
		
        $survey = Survey::where('status', "active")->first();
        $quiz = SurveyQuiz::where('survey_id', 1)->first();

		return view('admin.quizz', compact('survey', 'quiz'));
	}


	public function activateSurvey(Request $request, $id)
	{
		Survey::query()->update(['status' => "inactive"]);

		Survey::where('id', $id)
            ->update(array(
                'status' => "active"
            ));

          return back()->with('success', 'Survey acivated successfully');  
	}

	public function deactivateSurvey(Request $request, $id)
	{
		Survey::where('id', $id)
            ->update(array(
                'status' => "inactive"
            ));

           return back()->with('success', 'Survey deacivated successfully');
	}

	public function surveyEarning()
	{
		date_default_timezone_set('Africa/Nairobi');

		$activeSurvey = Survey::where('status', "active")->first();

		$checkEarning = surveyEarning::where('user_id', Auth::user()->id)->where('survey_id', $activeSurvey['id'])->where('date', date('Y-m-d'))->first();
		

		if($checkEarning)
		{
			return response()->json(["msg"=>"error"]);   
		}

        $survey = new surveyEarning;
        $survey->user_id=Auth::user()->id;
        $survey->survey_id=$activeSurvey['id'];
        $survey->amount=20;
        $survey->date=date('Y-m-d');

        $survey->save();

        return response()->json(["msg"=>"success"]);
	}

	public function addSurvey(Request $request)
	{

        $survey = new Survey;
        $survey->name=$request->name;
        $survey->note=$request->note;

        $survey->save();

        return back()->with('success', 'Survey submited successfully');   
	}

	public function addQuiz(Request $request)
	{
       $options = array();
        $options = $request->option;

        $survey = new SurveyQuiz;
        $survey->survey_id = $request->survey;
        $survey->quiz=$request->quiz;
        $survey->answer=$request->answer;

        $survey->save();

        foreach ($options as $option) {

        	$quiz = new QuizOp;

            $quiz->survey_quiz_id = $survey->id;
            $quiz->opt = $option;

            $quiz->save();

    }

        return back()->with('success', 'Quiz submited successfully');   
	}

	public function getQuizzes()
	{
		$quizzes = SurveyQuiz::with('options')->get();

    	return response()->json(['quizzes'=>$quizzes]);
	}

	public function youtube()
	{
		$video = Video::where('status', 'Approved')->first();

    	return view('admin.youtube', compact('video'));
	}
}
