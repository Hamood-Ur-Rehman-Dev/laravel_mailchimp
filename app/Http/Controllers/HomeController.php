<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;
use Mail;

class HomeController extends Controller
{
    protected $subscribers;
    protected $unSubscribers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->middleware('auth');

        $subscribers    = [];
        $unSubscribers  = [];
        $mailchimp      = Newsletter::getMembers();

        foreach ($mailchimp['members'] as $key => $member) {
            if($member['status'] == 'subscribed'){
                array_push($subscribers, $member['email_address']);
            }else{
                array_push($unSubscribers, $member['email_address']);
            }
        }

        $this->subscribers = $subscribers;
        $this->unSubscribers = $unSubscribers;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subscribers    = $this->subscribers;
        $unSubscribers  = $this->unSubscribers;
        return view('home', compact('subscribers', 'unSubscribers'));
    }

    public function subscribe(Request $request){
        $email = $request->email;

        if (!Newsletter::isSubscribed($email)){
            Newsletter::subscribe($email);

            $data = array('name' => $email);
            Mail::send('emails.subscription', $data, function ($message) use($email) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->to($email);
            });

            return redirect()->back()->with('success','Email ('.$email.') subscribed successfully...!');
        }

        return redirect()->back()->with('fail','Email ('.$email.') already subscribed...!');
    }

    public function unSubscribe(Request $request){
        $email = $request->email;

        Newsletter::unsubscribe($email);
        // Newsletter::delete($email);
        return redirect()->back()->with('success','Email ('.$email.') has been unsubscribed...!');
        
    }

    public function sendEmails()
    {
        
        foreach ($this->subscribers as $key => $email) {
            $data = array('name' => $email);
            Mail::send('emails.subscription', $data, function ($message) use($email) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->to($email);
            });
        }
       

        return redirect()->back()->with('email','Mails has been successfully sent to all subscribers...!');
    }
}
