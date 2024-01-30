<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    public function index(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers|max:30']);

        // else
        // {
        $token = hash('sha256', time());
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->token = $token;
        $subscriber->status = 'Pending';
        // $subscriber->save();

        $subscriber->save() ? 'You have successfully subscribed.' : 'Something went wrong, please try again.';

        // Send email
        $subject = 'Please Confirm Subscription';
        $verification_link = url('subscriber/verify/' . $token . '/' . $request->email);
        $message = 'Please click on the following link in order to verify as subscriber:<br><br>';

        // $message .= $verification_link;

        $message .= '<a href="' . $verification_link . '">';
        $message .= $verification_link;
        $message .= '</a><br><br>';
        $message .= 'If you received this email by mistake, simply delete it. You will not be subscribed if you do not  click the confirmation link above.';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        return view('email.check-mail');
        // }
    }

    public function verify($token, $email)
    {

        // Helpers::read_json();

        $subscriber_data = Subscriber::where('token', $token)->where('email', $email)->first();
        if ($subscriber_data) {
            $subscriber_data->token = '';
            $subscriber_data->status = 'Active';
            $subscriber_data->update();

            return redirect()->back()->with('success', 'You are successfully verified as a subscribe to this system');
        } else {
            return redirect()->route('form');
        }
    }

    public function show_all(Request $request)
    {
        if ($request->s) {

            $subscribers = Subscriber::where('title', 'LIKE', '%' . $request->s . '%')->paginate(10);

        } else {
            $subscribers = Subscriber::latest()->paginate(10);
        }
        return view('admin.subscriber_all', compact('subscribers'));
    }
    public function remove_subscriber($lang, $id)
    {
        $subscriber = Subscriber::find($id)->delete();
        return redirect()->back();
    }

    public function send_email()
    {
        return view('admin.subscriber-send-email');
    }

    public function send_email_submit(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $subject = $request->subject;
        $message = $request->message;

        $subscribers = Subscriber::where('status', 'Active')->get();
        foreach ($subscribers as $row) {
            \Mail::to($row->email)->send(new Websitemail($subject, $message));
        }

        return redirect()->back()->with('success', 'Email is Sent Successfully.');
    }
}
