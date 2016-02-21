<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateLog extends Model
{
    protected $table = 'upload_log';
    
	protected $start_record;
	
	protected $last_record;
	
	protected $fillable =  ['start_record', 'last_record'];
}
