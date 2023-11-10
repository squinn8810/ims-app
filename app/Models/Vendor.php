<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vendor';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'vendorID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendorName', 'vendorEmail', 'vendorPhone', 'vendorURL',
    ];

    /**
     * Get the items associated with the vendor.
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'vendorID');
    }
}
