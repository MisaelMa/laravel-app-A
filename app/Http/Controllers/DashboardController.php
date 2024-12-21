<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     */
    public function index(Request $request): Response
    {
        $user = Auth::user();

        $payload = [
            'user_id' => $user->id,
            'email' => $user->email,
            'timestamp' => now()->timestamp,
        ];

        $encryptedToken = Crypt::encrypt($payload);

        return Inertia::render('Dashboard', [
            'user' => $user,
            'payload' => $payload,
            'encryptedToken' => $encryptedToken,
            //'user' => Auth::user()->only('id', 'name', 'email'),
            // 'canResetPassword' => Auth::user() instanceof MustVerifyEmail,
        ]);
    }
}
