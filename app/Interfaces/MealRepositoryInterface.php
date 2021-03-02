<?php

namespace App\Interfaces;

interface MealRepositoryInterface {
    public function store($data);
    
    public function update($id, array $data);
    
    public function destroy($id);
}
