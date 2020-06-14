<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Mapel extends Model
{

	protected $table = "matapelajaran_sd";
	public $timestamps = false;
	protected $primaryKey = 'mapelKode';

}
