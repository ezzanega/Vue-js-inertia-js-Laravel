<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class SignUpController extends Controller
{
    /**
     * Display the Register view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/SignUp');
    }

    /**
     * Handle an incoming register request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'companyName' => 'required|string|max:125|unique:organizations,organization_name',
            'firstName' => 'required|string|max:125',
            'lastName' => 'required|string|max:125',
            'phoneNumber' => 'string|max:125',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8'
        ]);


        User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'phone_number' => $request->phoneNumber,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Organization::create([
            'organization_name' => $request->companyName
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME)->withSuccess('You have successfully registered & logged in!');
        }
    }
}
