<?php

declare(strict_types=1);

use App\Enums\UserStatusEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number', 20)->unique()->nullable();
            $table->foreignId('feature_image_id')->index()->nullable();
            $table->enum('user_type', [
                UserTypeEnum::USER_STUDENT->value,
                UserTypeEnum::USER_SCHOOL_MANAGEMENT->value,
            ])->default(UserTypeEnum::USER_STUDENT->value);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->default(UserStatusEnum::ACTIVE);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
