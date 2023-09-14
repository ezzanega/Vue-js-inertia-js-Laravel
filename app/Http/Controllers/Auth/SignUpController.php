<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Mail\MailHandler;
use App\Models\Insurance;
use App\Models\InviteUser;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\EmailTemplates;
use App\Services\TaskProService;
use App\Models\Enums\InsuranceType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class SignUpController extends Controller
{
    /**
     * Display the Register view.
     */
    public function create(Request $request): Response
    {
        $organization = $request->input('organization') ? $request->input('organization') : '';
        return Inertia::render('Auth/SignUp', ['organization' => $organization]);
    }

    /**
     * Handle an incoming register request.
     */
    public function store(Request $request, TaskProService $taskProService): RedirectResponse
    {
        $request->validate([
            'companyName' => 'required|string|max:125',
            'firstName' => 'required|string|max:125',
            'lastName' => 'required|string|max:125',
            'phoneNumber' => 'string|max:125',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8'
        ]);

        $taskProResponse = $taskProService->register($request->firstName, $request->lastName, $request->email, $request->password);

        $user = User::create([
            'taskpro_user_id' => array_key_exists('_id', $taskProResponse) ? $taskProResponse["_id"] : null,
            'taskpro_token' => array_key_exists('token', $taskProResponse) ? $taskProResponse["token"] : null,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'phone_number' => $request->phoneNumber,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $this->organizationSetup($request, $user, $taskProService);

        $emailTemplate = EmailTemplates::find(1);
        Mail::to($user->email)->send(new MailHandler($emailTemplate, [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'full_name' => $user->getFullName(),
            'phone_number' => $user->phone_number,
            'email' => $user->email,
        ]));

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME)->withSuccess('You have successfully registered & logged in!');
        }
    }

    private function organizationSetup(Request $request, User $user, TaskProService $taskProService)
    {
        $invitedUser = InviteUser::where('email', $user->email)->first();
        if (!$invitedUser) {
            $taskProResponse = $taskProService->createOrganization($request->companyName, $user);
            $organization = Organization::create([
                'taskpro_organization_id' => $taskProResponse["_id"],
                'name' => $request->companyName,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'owner_id' => $user->id
            ]);

            $user->assignRole('admin');
            $user->organization()->associate($organization);
            $user->save();
        } else {
            $user->assignRole($invitedUser->role);
            $organization = Organization::find((int)$invitedUser->organization);
            $user->organization()->associate($organization);
            $taskProService->addMember($organization->taskpro_organization_id, $user);
            $user->save();
            $invitedUser->delete();
        }
    }
}
