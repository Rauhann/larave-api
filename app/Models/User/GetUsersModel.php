<?php

namespace App\Models\User;

use App\Entities\UserEntity;

class GetUsersModel
{
    private $userEntity;

    public function __construct(UserEntity $userEntity)
    {
        $this->userEntity = $userEntity;
    }

    public function getUsers()
    {
        return $this->userEntity->get();
    }
}
