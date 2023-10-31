<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Organization extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'organization';

    protected $primaryKey = 'id';

    /**
     * 
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'superuser',
        'locID',
    ];

    /**
     * 
     */
    public function superuser()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * 
     */
    public function locID() 
    {
        return $this->belongsTo(Location::class, 'locID');
    }
}
