<?php

namespace App\Repositories;

use App\Interfaces\MKDBInterface;
use App\Models\t_mkdb_entry;

class MKDBRepository implements MKDBInterface
{
    public function storeUserData($data)
    {
        $user = t_mkdb_entry::where('email', $data['email'])->first();
        if ($user)
            return $user;
        else
            return t_mkdb_entry::create($data);
    }
}
