<?php

namespace App\Interfaces;

interface ActivitySessionRepositoryInterface {
    public function store($data);
    
    public function update($id, array $data);
    
    public function destroy($id);
}
