<?php

namespace Marvel\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Provider extends Model
{
	protected $table = 'providers';

	protected $fillable = ['provider', 'provider_user_id', 'user_id'];

	protected $hidden = [
		'created_at',
		'updated_at',
	];
}
