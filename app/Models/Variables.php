<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variables extends Model
{
    protected $table = 'variables';
    
	protected $name;
	
	protected $value;
	
	protected $fillable =  ['name', 'value'];
}
