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
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming register request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'organization_name' => 'required|string|max:250|unique:organizations',
            'siret' => 'string|max:250',
            'siren' => 'string|max:250',
            'address' => 'string|max:250',
            'billing_address' => 'string|max:250',
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8'
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Organization::create([
            'organization_name' => $request->organization_name,
            'siret' => $request->siret,
            'siren' => $request->siren,
            'address' => $request->address,
            'billing_address' => $request->billing_address,
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME)->withSuccess('You have successfully registered & logged in!');
        }
    }
}
