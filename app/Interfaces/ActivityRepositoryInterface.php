<?php

namespace App\Interfaces;

interface ActivityRepositoryInterface {
    public function all();
    
    public function find($id);
}
