<?php
declare(strict_types=1);

namespace App\Auth\Entity\User;

use InvalidArgumentException;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Webmozart\Assert\Assert;

final class Phone
{
    private readonly string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            /** @var PhoneNumber|null $phone */
            $phone = $phoneUtil->parse($value, 'RU');

            if (!is_null($phone)) {
                $isValid = $phoneUtil->isValidNumberForRegion($phone, 'RU');
                if ($isValid) {
                    $this->value = $phoneUtil->format($phone, PhoneNumberFormat::INTERNATIONAL);
                } else {
                    throw new InvalidArgumentException('Incorrect phone format');
                }
            } else {
                throw new InvalidArgumentException('Incorrect phone');
            }
        } catch (NumberParseException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}