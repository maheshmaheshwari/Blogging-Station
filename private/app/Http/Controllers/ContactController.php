<?php

namespace App\Http\Controllers;

use App\Helpers\Captcha;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function show()
    {
        return view('public.contact.show');
    }

    public function process(Request $request)
    {
        if ((bool)get_option('captcha_contact', 0) &&
            isset_captcha() &&
            !Captcha::verify($request->post())
        ) {
            session()->flash('danger', __('The CAPTCHA was incorrect. Try again'));
            return redirect()->route('contact.show')->withInput();
        }

        $data = request()->only(['name', 'email', 'body']);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            "email" => ['required', 'email', 'max:191'],
            "body" => ['required', 'max:191'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Mail::send(new Contact($data));

        session()->flash('success', __('Your message has been sent!'));

        return redirect()->back();
    }
}
