<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Guru extends Model
{

	protected $table = "guru_sd";
	public $timestamps = false;
	protected $primaryKey = 'guruNip';

}
