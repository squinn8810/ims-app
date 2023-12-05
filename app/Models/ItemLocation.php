<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLocation extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_location';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'itemLocID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itemNum', 'itemQty', 'itemReorderQty', 'locID',
    ];

    /**
     * Get the item that owns the item location.
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemNum');
    }

    /**
     * Get the location associated with the item location.
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'locID');
    }

    /**
     * Get the transactions associated with the item location.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'itemLocID');
    }

    public function getItemName() {
        $item = Item::find($this->itemNum);
        return $item->itemName;
    }
    
    public function getItem() {
        $item = Item::find($this->itemNum);
        return $item;
    }

    public function getVendorName() {
        $item = Item::find($this->itemNum);
        return $item->vendorName;
    }

    
    public function getLocationName(){
        $location = Location::find($this->locID);
        return $location->locName;
    }

    public function getMessage(){
        
        $item = $this->getItemName();
        $location = $this->getLocationName();
        $message = "$item from $location. Suggested reorder quantity $this->itemReorderQty.";
        
        return $message;
    }

}
