<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasswordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Password::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $haslo=$this->faker->word();
        
        return [
            'name' => $this->faker->word(),
            'password' => Crypt::encrypt($haslo),
            'users_id' => User::select('id')->orderByRaw("RAND()")->first()->id,
        ];
    }
}
