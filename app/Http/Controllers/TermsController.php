<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TermsAcceptedRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final class TermsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Terms');
    }

    public function store(TermsAcceptedRequest $request): RedirectResponse
    {
        Auth::user()->update([
            'terms_accepted_at' => now(),
        ]);

        return redirect()->route('dashboard');
    }
}
