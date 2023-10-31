<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * 
     */
    protected $table = 'vendor';

    /**
     * 
     */
    protected $primaryKey = 'vendorID';

    /** 
     * 
    */
    protected $fillable = [
        'vendorName', 'vendorEmail', 'vendorPhone', 'vendorURL',
    ];

    /**
     * 
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'vendorID');
    }

}
