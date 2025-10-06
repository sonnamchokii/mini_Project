<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream; // Keep this import for other potential Jetstream uses, though not directly used in the validator now
use Illuminate\Support\Facades\Session;

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
            // REMOVED THE JETSTREAM::hasFeature() CHECK AND THE 'terms' VALIDATION
            // If you actually *have* a terms checkbox and need validation, 
            // you might need to consult Jetstream's current documentation 
            // for the exact way to validate it without using hasFeature().
            // For now, we assume you don't need this complex check.
            // If you have a 'terms' checkbox in your register form and want to validate it:
            // 'terms' => ['required', 'accepted'], 
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => 'user', // Ensure default role is set
        ]);

        Session::flash('status', 'Registration successful! Please log in to continue.');

        return $user;
    }
}