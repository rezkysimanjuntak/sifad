<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kelas extends Model
{
  protected $table = "kelas_sd";
  public $timestamps = false;
  protected $primaryKey = 'kelasKode';


}
