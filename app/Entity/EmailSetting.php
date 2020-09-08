<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    protected $table ='email_setting';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
