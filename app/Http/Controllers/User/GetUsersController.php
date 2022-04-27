<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\GetUsersModel;

class GetUsersController extends Controller
{
    private $getUserModel;

    public function __construct(GetUsersModel $getUserModel)
    {
        $this->getUserModel = $getUserModel;
    }

    public function __invoke()
    {
        $users = $this->getUserModel->getUsers();

        return response()->json($users);
    }
}
