<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : $this->redirectBasedOnGuard($request);
    }

    /**
     * Redirect based on the authenticated guard
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBasedOnGuard($request)
    {
        // Check if admin is authenticated
        if (Auth::guard('admins')->check()) {
            return redirect()->to('/admin/dashboard');
        }
        
        // Default to regular user dashboard
        return redirect()->to('/dashboard');
    }
}
