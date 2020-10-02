<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class District extends Model
{
    use SoftDeletes;

    public $timestamps = true; // auto populate the timestamp columns in the db
    protected $fillable = ['district_name', 'inclusive']; // MASS INSERTION OF DATA INTO THE DB
    protected $dates = ['deleted_at'];




}
?>