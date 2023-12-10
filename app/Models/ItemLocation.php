<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model representing the relationship between items and locations.
 */
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemNum');
    }

    /**
     * Get the location associated with the item location.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'locID');
    }

    /**
     * Get the current quantity of the item at this location.
     *
     * @return int
     */
    public function getCurrentQty()
    {
        return $this->itemQty;
    }

    /**
     * Get the reorder quantity for the item at this location.
     *
     * @return int
     */
    public function getItemReorderQty()
    {
        return $this->itemReorderQty;
    }

    /**
     * Get the name of the item associated with this location.
     *
     * @return string
     */
    public function getItemName()
    {
        $item = Item::find($this->itemNum);
        return $item->itemName;
    }

    /**
     * Get the item associated with this location.
     *
     * @return \App\Models\Item
     */
    public function getItem()
    {
        $item = Item::find($this->itemNum);
        return $item;
    }

    /**
     * Get the vendor name associated with the item at this location.
     *
     * @return string
     */
    public function getVendorName()
    {
        $item = Item::find($this->itemNum);
        return $item->vendorName;
    }

    /**
     * Get the name of the location associated with this item location.
     *
     * @return string
     */
    public function getLocationName()
    {
        $location = Location::find($this->locID);
        return $location->locName;
    }

    /**
     * Get a descriptive message about the item location.
     *
     * @return string
     */
    public function getMessage()
    {
        $item = $this->getItemName();
        $location = $this->getLocationName();
        $message = "$item from $location. Suggested reorder quantity $this->itemReorderQty.";

        return $message;
    }
}
