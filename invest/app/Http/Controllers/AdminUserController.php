<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Referral;
use App\Package;
use App\PackageUser;
use App\Deposit;
use App\Withdrawal;
use Illuminate\Support\Facades\Hash;
use App\Notifications\HelloUser;
use App\Notifications\ResetPass;
use Auth;
use File;
use Mail;

class AdminUserController extends Controller
{
    
    public function index()
    {

    	// $this->updateInterest();

    	
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

    	$users = User::all()->count();
    	$todayUsers = User::where('date', date('Y-m-d'))->count();
    	$activeUsers = User::where('active', 1)->count();

       
       return view('admin.index', compact('users','activeUsers', 'todayUsers'));
    }

    public function withdrawals()
    {
    	$withdrawals = Withdrawal::all();
       
       return view('admin.withdrawal', compact('withdrawals'));
    }

    public function deposits()
    {
    	$deposits = Deposit::all();
       
       return view('admin.deposit', compact('deposits'));
    }

    public function users()
    {
    	$users = User::all();
       
       return view('admin.users', compact('users'));
    }

    public function getUser($id)
    {
    	$user = User::where('id', $id)->first();
       
       return response()->json([$user]);
    }

    public function getPackage($id)
    {
    	$package = Package::where('id', $id)->first();
       
       return response()->json([$package]);
    }

    public function resetUserPass(Request $request)
	{
		$password = Hash::make($request->password);

		user::where('id', $request->id)
            ->update(array(
                'password' => $password
            ));

         return back()->with('success', 'Password reset successfully!');
	}


		public function changeUplink(Request $request)
	{
		$user = User::where('username',$request->username)->first();
		
		$level = Referral::where('user_id',$request->id)->where('level', 1)->first();
		
		if($user)
		{
		    if($level)
		    {
		         Referral::where('user_id', $request->id)
		    ->where('level', 1)
            ->update(array(
                'referrer' => $user->id
            ));
             return back()->with('success', 'Upline changed successfully!');
		    }
		    else
		    {

              $uplink = new Referral();

              $uplink->referrer = $user->id;
              $uplink->level = 1;
              $uplink->user_id = $request->id;

              $uplink->save();
            
             return back()->with('success', 'Upline changed successfully!');
		    }
         
		}
		else
		{
		    return back()->with('warning', 'User does not exist!');
		}

		
	}

	public function updateUser(Request $request)
    {
        User::where('id', $request->id)
        ->update(array(
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'wallet' => $request->wallet,
            'country' => $request->country,
        ));

        return back()->with('success', 'User details updated Successfully');  
    }

    public function updatePackage(Request $request)
    {
        Package::where('id', $request->id)
        ->update(array(
            'name' => $request->name,
            'details' => $request->details,
            'amount' => $request->amount,
        ));

        return back()->with('success', 'Package details updated Successfully');  
    }

	public function deleteUser(User $user)
    {
        $user->delete();

        return back()->with('success', 'User Deleted Successfully');
    }

    public function deletePackage(Package $package)
    {
        $package->delete();

        return back()->with('success', 'Package Deleted Successfully');
    }

    public function quickSearch(Request $request)
   {
     $user = User::where('email', $request->search)
    ->orWhere('phone', $request->search)
    ->orWhere('username', $request->search)->first();
      
      return view('admin.search', compact('user'));
   }

   public function depositForUser(Request $request)
   {


   	user::where('id', $request->id)
          ->increment('deposit',$request->amount);


         return back()->with('success', 'Account Credited Successfully');
   }

    public function completed($id)
    {
    	 Withdrawal::where('id', $id)
            ->update(array(
                'status' => 1
            ));

         return back()->with('success', 'Action completed successfully!');
    }

    public function pending($id)
    {
    	 Withdrawal::where('id', $id)
            ->update(array(
                'status' => 0
            ));

         return back()->with('success', 'Action completed successfully!');
    }
}
