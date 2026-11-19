<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class ReviewerController extends Controller
{
    public function show(User $user): View
    {
        $user->load([
            'reviews' => fn ($query) => $query
                ->with('eatery')
                ->latest(),
        ]);
        $user->loadCount('reviews');

        return view('reviewers.show', compact('user'));
    }
}
