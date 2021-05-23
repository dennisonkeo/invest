<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SpinAward;
use App\Transaction;
use App\SurveyEarning;
use App\Survey;
use App\Payment;
use App\PayMethod;
use App\Blog;
use App\Referral;
use App\Video;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function index()
    {
    	$users = User::all();
    	$activeUsers = User::where('status', 'active')->get();
    	$recentUsers = User::orderBy('id', 'desc')->take(5)->get();
    	$spinEarnings = SpinAward::sum('amount');
    	$withdrawals = Transaction::sum('amount');
    	$survey = SurveyEarning::sum('amount');
    	
    	return view('system_admin.dashboard', compact('spinEarnings', 'activeUsers', 'withdrawals', 'survey', 'users', 'recentUsers'));
    }

    public function users()
    {
    	$users = User::all();

    	return view('system_admin.allUsers', compact('users'));
    }


    public function surveManagerPage()
	{
		
        $surveys = Survey::all();

		return view('system_admin.survey', compact('surveys'));
	}

	public function withdrawals()
	{
		
        $transactions = Transaction::all();

		return view('system_admin.withdrawals', compact('transactions'));
	}
	

	public function payments()
	{
		
        $payments = Payment::all();

		return view('system_admin.payments', compact('payments'));
	}

	public function paymentMethods()
	{
		
        $types = PayMethod::all();

		return view('system_admin.paymethods', compact('types'));
	}

	public function blogs()
	{
		
        $blogs = Blog::all();

		return view('system_admin.blog', compact('blogs'));
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


	public function activateUser(Request $request, $id)
	{
		$users = Referral::where('user_id',$id)->get();

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

	 user::where('id', $id)
            ->update(array(
                'status' => "active"
            ));

	  return back()->with('success', 'User activated successfully!');


	}

	public function deleteUser(User $user)
    {
        $user->delete();

        return back()->with('success', 'User Deleted Successfully');
    }

    public function approveBlog(Request $request, $id)
    {
        Blog::where('id', $id)
            ->update(array(
                'status' => "Approved",
                'amount' => 20
            ));

	  return back()->with('success', 'Blog approved successfully!');
    }

    public function approveWithdrawal(Request $request, $id)
    {
        Transaction::where('id', $id)
            ->update(array(
                'status' => "Approved"
            ));

	  return back()->with('success', 'Transaction approved successfully!');
    }

    public function youtube()
    {
    	return view('system_admin.youtube');
    }

    public function video()
    {
    	$videos = Video::all();

    	return view('system_admin.video', compact('videos'));
    }


    public function upload_video(Request $request){ 

    	$this->validate($request, [
	        'file' => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts,mkv|required',
	        ]);

      $originalVideo= $request->file('file');


            $video = $request->file('file');

            $video_name = time().$video->getClientOriginalName();

            $video->move(public_path('admin/assets/videos'),$video_name);

            $videoPath = "admin/assets/videosg/$video_name";


              $upload = new Video();

              $upload->video = $video_name;
              $upload->title = $request->title;
              $upload->note = $request->note;

              $upload->save();

              return back()->with('success', 'Video uploaded successfully!');
}

  public function deleteVideo(Video $video)
    {

    	File::delete([public_path("admin/assets/videos/".$video->video)]);

        $video->delete();

        return back()->with('success', 'Video Deleted Successfully');
    }

    public function approveVideo(Request $request, $id)
    {
    	Video::query()->update(['status' => "Not Approved"]);

        Video::where('id', $id)
            ->update(array(
                'status' => "Approved"
            ));

	  return back()->with('success', 'Video approved successfully!');
    }

    public function settings()
    {
    	return view('system_admin.settings');
    }

}
