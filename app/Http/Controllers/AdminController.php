<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function ban(Request $request): RedirectResponse
    {
        $bannedUser = User::find($request->id);
        if ($bannedUser->hasPermissionTo('restrict access')) {
            $bannedUser->revokePermissionTo('restrict access');
        } else {
            $bannedUser->givePermissionTo('restrict access');
        }

        return Redirect::route('dashboard')->with('message', 'banned');
    }
}
