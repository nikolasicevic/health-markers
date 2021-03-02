<?php

namespace App\Interfaces;

interface SleepSessionRepositoryInterface {
    public function find($id);
    
    public function update($id, array $data);
}
