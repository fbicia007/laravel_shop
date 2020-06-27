<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $table='member';
    protected $primaryKey='id';
    protected $email='email';
    protected $password='password';
    protected $firstName='firstName';
    protected $lastName='lastName';
    protected $city='city';
    protected $state='state';
    protected $zip='zip';
    protected $phone='phone';
}
