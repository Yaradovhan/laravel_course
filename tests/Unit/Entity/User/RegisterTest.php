<?php

namespace Tests\Unit\Entity\User;

use App\Entity\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{


    public function testVerify() :void
    {
        $user = User::register('name', 'email','password');
        $user->verify();

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());
    }
    
    public function testAlreadyVerified() :void
    {
        $user = User::register('name', 'email','password');
        $user->verify();

        $this->expectExceptionMessage('User is already verified');
        $user->verify();
    }
}
