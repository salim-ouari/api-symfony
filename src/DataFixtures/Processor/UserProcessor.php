<?php

namespace App\DataFixtures\Processor;

use Fidry\AliceDataFixtures\ProcessorInterface;
use symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

final class UserProcessor implements ProcessorInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHashe)
    {
        $this->passwordHasher = $passwordHashe;
    }

    /**
     * @inheritdoc
     */
    public function preProcess(string $fixture, object $object): void
    {
        if (false === $object instanceof User) {
            return;
        }

        $object->setPassword($this->passwordHasher->hashPassword($object, $object->getPassword()));
    }

    /**
     * @inheritdoc
     */
    public function postProcess(string $fixture, object $object): void
    {
        // do nothing
    }
}
