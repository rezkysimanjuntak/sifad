<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Nilai extends Model
{

	protected $table = "nilai_sd";
	public $timestamps = false;
	protected $primaryKey = 'nilaiId';

}
