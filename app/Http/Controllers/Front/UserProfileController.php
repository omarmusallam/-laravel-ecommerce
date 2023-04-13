<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('front.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['required', 'string', 'size:2'],
        ]);

        $user = $request->user(); // $user = Auth::user();

        $user->userprofile->fill($request->all())->save();

        // if ($profile->first_name) {
        //     $profile->update($request->all());
        // } else {
        //     $request->merge([
        //         'user_id' => $user->id,
        //     ]);
        //     UserProfile::create($request->all());

        //     $user->userprofile()->create($request->all());
        // }

        return redirect()->route('user-profile.edit')
            ->with('success', 'Profile updated!');
    }
}