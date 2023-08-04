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

    // MailTemplatesController.php

public function update(Request $request, EmailTemplates $mail)
{
    $organization = $request->user()->organization;

    // Check if the email template belongs to the user's organization
    if ($mail->organization_id !== $organization->id) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'subject' => 'required|string|max:255',
        'body' => 'required|min:3|max:3000',
    ]);

    $mail->update([
        'type' => MailType::CUSTOM,
        'name' => Str::slug($request->subject),
        'subject' => $request->subject,
        'body' => $request->body,
    ]);

    return back();
    }
    
    public function delete(EmailTemplates $id)
    {
        $emailTemplate = EmailTemplates::where(['id' => $id])->first();
        $emailTemplate->delete();
        return back();
    }
}
