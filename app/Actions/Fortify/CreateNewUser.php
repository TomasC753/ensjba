<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        // dd($input);
        Validator::make($input, [
            'role' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:255'],
            'date_birth' => ['required'],
            'gender' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'andress' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        // dd($input['role']);
        // dd(Role::where('name', $input['role'])->first()->id);
        $user = new User;
        $user->name = $input['name'];
        $user->lastName = $input['lastName'];
        $user->dni = $input['dni'];
        $user->date_birth = $input['date_birth'];
        $user->gender = $input['gender'];
        $user->country = $input['country'];
        $user->andress = $input['andress'];
        $user->phone_number = $input['phone_number'];
        $user->house_phone_number = $input['house_phone_number'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->save();
        // dd(Role::where('name', $input['role'])->first());
        $user->roles()->attach(Role::where('name', $input['role'])->first()->id);

        return $user;
    }
}
