<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Retrieve Current User's Profile information
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentProfile(Request $request)
    {
        $currentUser = new UserResource($request->user());

        return response()->json($currentUser,Response::HTTP_OK);
    }

    /**
     * Update the user's profile information.
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        // Update the user attributes
        $request->user->update($request->only(['firstName', 'lastName', 'email', 'id']));

        // $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        $currentUser = new UserResource($request->user());

        return response()->json($currentUser, Response::HTTP_OK);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): Response
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response(Response::HTTP_OK);
    }
}
