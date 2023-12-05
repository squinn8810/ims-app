<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'itemNum';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itemName', 'itemURL', 'vendorName', 'vendorID',
    ];

    /**
     * Get the vendor that owns the item.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendorID');
    }

    /**
     * Get the locations associated with the item.
     */
    public function locations()
    {
        return $this->hasMany(ItemLocation::class, 'itemLocID');
    }

    public function getVendor(){
        $vendor = Vendor::find($this->vendorID);
        return $vendor;
    }
}
