<?php

namespace App\Actions\Fortify;

use App\Models\User;
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
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'usertype' => ['required', 'in:admin,camis,clerk,judge,division'],
            'contact_number' => $input['usertype'] === 'judge' || $input['usertype'] === 'camis'
                ? ['required', 'string', 'size:11']
                : ['nullable'],
            'division' => $input['usertype'] === 'judge' || $input['usertype'] === 'division'
                ? ['required', 'integer', 'min:1', 'max:5']
                : ['nullable'],
            'atty_number' => $input['usertype'] === 'camis'
                ? ['required', 'string', 'max:255']  // Customize validation as needed
                : ['nullable'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'usertype' => $input['usertype'],
            'contact_number' => in_array($input['usertype'], ['judge', 'camis']) ? $input['contact_number'] : null,
            'division' => in_array($input['usertype'], ['judge', 'division']) ? $input['division'] : null,
            'atty_number' => $input['usertype'] === 'camis' ? $input['atty_number'] : null,
            'criminal_cases_solved' => 0,
            'civil_cases_solved' => 0,
            'special_cases_solved' => 0,
        ]);
    }
}
