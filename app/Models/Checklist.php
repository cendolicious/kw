<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = true;

    protected $fillable = [
        'object_domain',
        'object_id',
        'due',
        'urgency',
        'is_completed',
        'description',
        'task_id',
        'created_at',
        'updated_at'
    ];

    protected $attributes = array(
        'is_completed' => false,
//        'created_at' => 'dsa',
//        'update_at' => 'das'
    );

    protected $table = "checklist";
}