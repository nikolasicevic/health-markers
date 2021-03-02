<?php

namespace App\Interfaces;

interface DayRepositoryInterface {
    public function all();

    public function search(array $data);

    public function create();
    
    public function lastDay();
    
    public function lastDays($number);

    public function find($id);
    
    public function update($id, array $data);
    
    public function setData($days, bool $withChartData);
}
