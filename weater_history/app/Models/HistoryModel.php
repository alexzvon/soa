<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryModel extends Model
{
    protected $table = 'history';

    protected $fillable = [ 'id', 'temp', 'date_at'];

    public $timestamps = false;
}
