<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model for the "transaction" table.
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
     */
    public function itemLocation()
    {
        return $this->belongsTo(ItemLocation::class, 'itemLocID');
    }

    /**
     * Get the employee associated with the transaction.
     */
    public function employee()
    {
        return $this->belongsTo(Account::class, 'employeeID');
    }

    
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('F d, Y');
    }
    
    public function getItemName() {
        $itemLoc = ItemLocation::find($this->itemLocID);
        $item = Item::find($itemLoc->itemNum);
        return $item->itemName;
    }

    public function getVendor() {
        $itemLoc = ItemLocation::find($this->itemLocID);
        $item = Item::find($itemLoc->itemNum);
        $vendor = Vendor::find($item->vendorID);
        return $vendor;
    }

    public function getLocationName(){
        $itemLoc = ItemLocation::find($this->itemLocID);
        $location = Location::find($itemLoc->locID);
        return $location->locName;
    }

    public function getItemAtLocation(){
        $item = ItemLocation::find($this->itemLocID);
        return $item;
    }

    public function getCurrentQty(){
        $itemLoc = ItemLocation::find($this->itemLocID);
        return $itemLoc->itemQty;
    }

    public function getUserName() {
        $user = User::find($this->employeeID);
        return "$user->firstName $user->lastName";
    }

    public function getDataAsJson()
    {
        //Item
        $itemLoc = ItemLocation::find($this->itemLocID);
        $item = Item::find($itemLoc->itemNum);
        //Location & Reorder Qty
        $location = Location::find($itemLoc->locID);
        //User
        $user = User::find($this->employeeID);
        $user = "$user->firstName $user->lastName";

        return [
            'Date' => $this->getDateAttribute($this->transDate),
            'Item' => $item->itemName,
            'Qty Removed/Restocked' => $this->itemQty,
            'Suggested Reorder Qty' => $itemLoc->itemReorderQty,
            'Location' => $location->locName,
            'Status' => $this->status,
            'Employee' => $user,
        ];
    }

    public function getLowSupplyMessage()
    {
        $data = $this->getDataAsJson(); 
        $itemLoc = ItemLocation::find($this->itemLocID);

        $item = $data['Item']; 
        $location = $data['Location'];
        $user = $data['Employee'];
        $reorderQty = $data['Suggested Reorder Qty'];
        $itemQty = $itemLoc->itemQty;


        $message = "$item at $location by $user. Quantity available: $itemQty. Suggested reorder quantity: $reorderQty.";

        return $message;
    }


    /**
     * Get a custom message for the transaction.
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


        $message = "$item at $location by $user. Quantity available: $itemQty. Quantity added to inventory: $restockedQty.";

        return $message;
    }
}
