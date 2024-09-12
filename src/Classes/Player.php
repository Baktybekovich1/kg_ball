<?php

namespace App\Classes;

class Player
{
    public string $name;
    public string $surname;
    public int $age;

//======Свойства========================

    public function __construct($name,$surname, $age)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
    }

//    public function setId(int $id): void
//    {
//        $this->id = $id;
//    }
//
//    public function setAge(int $age): void
//    {
//        $this->age = $age;
//    }
//
//    public function setName(string $name): void
//    {
//        $this->name = $name;
//    }


    public function rename(): string
    {
        return 'Method rename is work';
    }


//======Методы============================
}