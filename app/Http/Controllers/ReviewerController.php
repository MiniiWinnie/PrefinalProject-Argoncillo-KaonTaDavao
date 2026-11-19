<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class ReviewerController extends Controller
{
    public function show(User $user): View
    {
        return view('reviewers.show', compact('user'));
    }
}
