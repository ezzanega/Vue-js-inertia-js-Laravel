<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmailTemplates;
use App\Models\Enums\MailType;
use Illuminate\Support\Facades\Redirect;


class MailTemplatesController extends Controller
{

    public function index(Request $request)
    {
        $organization = $request->user()->organization;
        $templates = EmailTemplates::where('organization_id', $organization->id)->get();
        return Inertia::render('6dem/Templates', ['templates' => $templates]);
    }

    public function store(Request $request)
    {
        $organization = $request->user()->organization;

        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|min:3|max:3000',
        ]);

        $organization->emailTemplates()->create([
            'type' => MailType::CUSTOM,
            'name' => Str::slug($request->subject),
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return back();
    }

    public function delete(EmailTemplates $mail)
    {
        $mail->delete();
        return redirect()->back();
        //return Redirect::route('6dem.mail.templates');
    }
}
