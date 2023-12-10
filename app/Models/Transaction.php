<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model representing the "transaction" table.
 */
class Transaction extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'transNum';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transDate', 'itemLocID', 'employeeID', 'status', 'itemQty'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $enumCasts = [
        'status' => 'array'
    ];

    /**
     * Get the item location associated with the transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itemLocation()
    {
        return $this->belongsTo(ItemLocation::class, 'itemLocID');
    }

    /**
     * Get the employee associated with the transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * Get the formatted date attribute.
     *
     * @param  mixed  $value
     * @return string
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('M d, y');
    }

    /**
     * Get the name of the item associated with this transaction.
     *
     * @return string
     */
    public function getItemName()
    {
        $itemLoc = ItemLocation::find($this->itemLocID);
        $item = Item::find($itemLoc->itemNum);
        return $item->itemName;
    }

    /**
     * Get the vendor associated with this transaction's item.
     *
     * @return \App\Models\Vendor
     */
    public function getVendor()
    {
        $itemLoc = ItemLocation::find($this->itemLocID);
        $item = Item::find($itemLoc->itemNum);
        $vendor = Vendor::find($item->vendorID);
        return $vendor;
    }

    /**
     * Get the name of the location associated with this transaction.
     *
     * @return string
     */
    public function getLocationName()
    {
        $itemLoc = ItemLocation::find($this->itemLocID);
        $location = Location::find($itemLoc->locID);
        return $location->locName;
    }

    /**
     * Get the item location associated with this transaction.
     *
     * @return \App\Models\ItemLocation
     */
    public function getItemAtLocation()
    {
        return ItemLocation::find($this->itemLocID);
    }

    /**
     * Get the current quantity of the item at this location.
     *
     * @return int
     */
    public function getCurrentQty()
    {
        $itemLoc = ItemLocation::find($this->itemLocID);
        return $itemLoc->itemQty;
    }

    /**
     * Get the full name of the user associated with this transaction.
     *
     * @return string
     */
    public function getUserName()
    {
        $user = User::find($this->employeeID);
        return "$user->firstName $user->lastName";
    }

    /**
     * Get the transaction data as an associative array.
     *
     * @return array
     */
    public function getDataAsJson()
    {
        $itemLoc = ItemLocation::find($this->itemLocID);
        $item = Item::find($itemLoc->itemNum);
        $location = Location::find($itemLoc->locID);
        $user = User::find($this->employeeID);

        return [
            'Date' => $this->getDateAttribute($this->transDate),
            'Item' => $item->itemName,
            'Qty Removed/Restocked' => $this->itemQty,
            'Suggested Reorder Qty' => $itemLoc->itemReorderQty,
            'Location' => $location->locName,
            'Status' => $this->status,
            'Employee' => "$user->firstName $user->lastName",
        ];
    }

    /**
     * Get a descriptive message for a low supply transaction.
     *
     * @return string
     */
    public function getLowSupplyMessage()
    {
        $data = $this->getDataAsJson(); 
        $itemLoc = ItemLocation::find($this->itemLocID);

        $item = $data['Item']; 
        $location = $data['Location'];
        $user = $data['Employee'];
        $reorderQty = $data['Suggested Reorder Qty'];
        $itemQty = $itemLoc->itemQty;

        return "$item at $location by $user. Quantity available: $itemQty. Suggested reorder quantity: $reorderQty.";
    }

    /**
     * Get a descriptive message for a restock transaction.
     *
     * @return string
     */
    public function getRestockMessage()
    {
        $data = $this->getDataAsJson(); 
        $itemLoc = ItemLocation::find($this->itemLocID);

        $item = $data['Item']; 
        $location = $data['Location'];
        $user = $data['Employee'];
        $restockedQty = $data['Qty Removed/Restocked'];
        $itemQty = $itemLoc->itemQty;

        return "$item at $location by $user. Quantity available: $itemQty. Quantity added to inventory: $restockedQty.";
    }
}
