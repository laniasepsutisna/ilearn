<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class UserMeta extends Model
{
	use UuidModel;

	public $incrementing = false;

	public $timestamps = false;

	protected $fillable = [
		'user_id', 'major_id', 'nis', 'nisn', 'agama', 'tempatlahir', 'tanggallahir', 'orangtua', 'wali', 'alamat', 'telp', 'telp_orangtua', 'picture', 'cover', 'bio'
	];

	protected $hidden = [
		'id', 'user_id', 'major_id'
	];
}
