<?php
declare(strict_types=1);

namespace Growonic\Infrastructure\Persistence\Doctrine\CustomType;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Growonic\Domain\User\UserId;

class DoctrineUserId extends GuidType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'UserId';
    }

    /**
     * @param UserId $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->id();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return UserId
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return UserId::create($value);
    }
}