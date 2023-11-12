<?php

namespace App\Console\Commands;

use App\Enums\UserTypeEnum;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class Administration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:vinco-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user for the Vinco platform';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = text(
            'What is the name of the user?',
            'John Doe',
            required: true
        );

        $user_type = select(
            'What is the user type?',
            array_map(fn(UserTypeEnum $user_type) => $user_type->value, UserTypeEnum::cases()),
            default: UserTypeEnum::USER_STUDENT->value,
            validate: function ($value) {
                try {

                    return true;
                } catch (ValidationException $th) {
                    return $th->errors()['value'][0];
                }
            }
        );

        $email = text(
            'What is your email address',
            required: true
        );
    }
}
