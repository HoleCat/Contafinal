<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userdata extends Model
{
    protected $fillable = ['user_id','empresa_id','aprobador_id','nombre','apellido','dni','ruc', 'foto'];
}
