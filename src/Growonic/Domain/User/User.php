<?php
declare(strict_types=1);

namespace Growonic\Domain\User;

use Growonic\Domain\ValueObject\Email;
use Growonic\Domain\ValueObject\Password;

class User
{
    /** @var UserId */
    private $id;

    /** @var Email */
    private $email;

    /** @var Password */
    private $password;

    public function __construct(Email $email, Password $password)
    {
        $this->id = UserId::create();
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }
}
