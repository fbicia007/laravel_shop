<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class TempEmail extends Model
{
    protected $table ='temp_email';
    protected $primaryKey = 'id';
    protected $member_id = 'member_id';
    protected $code = 'uuid';
    protected $deadline = 'deadline';
    public $timestamps = false;
}
