<?php
declare(strict_types=1);

namespace App\Auth\Service;

use App\Auth\Entity\User\Phone;
use App\Auth\Entity\User\Token;

interface LoginConfirmationSender
{
    public function send(Phone $phone): Token;
}
