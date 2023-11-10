<?php

use App\Enums\UserStatusEnum;
use App\Enums\UserTypeEnum;

describe('Architecture', function () {

    // add it block to verify if each class in enum folder has suffix Enum
    test('enum classes have Enum suffix')
        ->expect('App\Enums')
        ->toBeEnums();

    it('has Enum suffix', function () {
        $reflection = new ReflectionClass(UserStatusEnum::class);

        expect($reflection->getShortName())
            ->toEndWith('Enum');
    });

    // add it block to test ACTIVE value
    it('returns correct value for ACTIVE', function () {
        $status = UserStatusEnum::ACTIVE;
        // verify that the value is correct
        expect($status->value)->toBe(1);
    });

    // add it block to test INACTIVE value
    it('returns correct value for INACTIVE', function () {
        $status = UserStatusEnum::INACTIVE;

        expect($status->value)->toBe(0);
    });

    test('globals')
        ->expect(['dd', 'dump'])
        ->not->toBeUsed();
});

describe('UserTypeEnum', function () {

    // add it block to test USER_STUDENT value
    it('returns correct value for USER_STUDENT', function () {
        $userType = UserTypeEnum::USER_STUDENT;

        expect($userType->value)->toBe('student');
    });

    // add it block to test USER_SCHOOL_MANAGEMENT value
    it('returns correct value for USER_SCHOOL_MANAGEMENT', function () {
        $userType = UserTypeEnum::USER_SCHOOL_MANAGEMENT;

        expect($userType->value)->toBe('school_management');
    });
});
