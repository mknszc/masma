<?php

namespace App\Repositories;

use App\Models\Application;

class ApplicationRepository
{
    public function getById(int $id)
    {
        return Application::where('id', $id)->first();
    }
}