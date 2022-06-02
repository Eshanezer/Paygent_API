<?php

namespace App\Repositories;

use App\Interfaces\MKDBInterface;
use App\Models\t_mkdb_entry;

class MKDBRepository implements MKDBInterface{
    public function storeUserData($data){
        return t_mkdb_entry::create($data);
    }
}
