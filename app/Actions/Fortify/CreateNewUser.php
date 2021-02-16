<?php

namespace App\Actions\Fortify;

use App\Models\Contact;
use App\Models\Role;
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
            'phone' => 'max:11|required',
            'address' => 'required'
        ])->validate();

        // dd($input);
        $role = Role::firstOrCreate(['name' => 'Customer']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $role->id
        ]);
        $response = [
            'title' => 'Welcome',
            'msg' => 'We are glad to have you on board!',
            'type' => 'success'
        ];
        $contact = new Contact();
        $contact->phone = $input['phone'];
        $contact->address = $input['address'];
        $contact->user_id = $user->id;
        $contact->save();
        session()->flash('status', $response);

        return $user;
    }
}