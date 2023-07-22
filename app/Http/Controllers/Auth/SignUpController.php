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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'companyName' => 'required|string|max:125|unique:organizations,name',
            'firstName' => 'required|string|max:125',
            'lastName' => 'required|string|max:125',
            'phoneNumber' => 'string|max:125',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'phone_number' => $request->phoneNumber,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $this->organizationSetup($request, $user);

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

    private function organizationSetup(Request $request, User $user)
    {
        $invitedUser = InviteUser::where('email', $user->email)->first();
        if (!$invitedUser) {
            $organization = Organization::create([
                'name' => $request->companyName,
                'owner_id' => $user->id
            ]);
            $insurance = Insurance::create([
                'type' => InsuranceType::ADVALOREM,
                'max_value' => "",
                'franchise' => "",
                'amount_ht' => "",
                'organization_id' => $organization->id
            ]);

            $insurance = Insurance::create([
                'type' => InsuranceType::CONTRACTUAL,
                'max_value' => "",
                'franchise' => "",
                'amount_ht' => "",
                'organization_id' => $organization->id
            ]);

            $user->organization()->associate($organization);
            $user->save();
        } else {
            $organization = Organization::find((int)$invitedUser->organization);
            $user->organization()->associate($organization);
            $user->save();
            $invitedUser->delete();
        }
    }
}
