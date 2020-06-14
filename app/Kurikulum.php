<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kurikulum extends Model
{
	//protected $primaryKey = "idx";
	protected $table = "kurikulum_sd";
	public $timestamps = false;
	protected $primaryKey = 'kurId';

}
