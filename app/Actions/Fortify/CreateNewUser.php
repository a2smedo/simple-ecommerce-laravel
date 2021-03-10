<?php

namespace App\Actions\Fortify;

use App\Models\Rule as ModelsRule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),

            'country' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'address' => ['required', 'string'],
        ])->validate();

        $user = ModelsRule::where('name', 'user')->first();
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'rule_id' => $user->id,
            'country' => $input['country'],
            'city' => $input['city'],
            'phone' => $input['phone'],
            'address' => $input['address'],
        ]);
    }
}
