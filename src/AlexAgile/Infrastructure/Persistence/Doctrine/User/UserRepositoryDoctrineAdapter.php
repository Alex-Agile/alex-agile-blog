<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\User;

use Doctrine\ORM\EntityManagerInterface;
use AlexAgile\Domain\User\User;
use AlexAgile\Domain\ValueObject\Email;

final class UserRepositoryDoctrineAdapter implements \AlexAgile\Domain\User\UserRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(Email $email):? User
    {
        $userCollection = $this->em->getRepository(User::class)->findByEmail($email);

        if ($userCollection) {
            return $userCollection[0];
        }

        return null;
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function save(User $user):void
    {
        $this->em->persist($user);
        $this->em->flush();
    }
}