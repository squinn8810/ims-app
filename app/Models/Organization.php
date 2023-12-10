<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model representing the "organization" table.
 */
class Organization extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organization';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'superuser',
    ];

    /**
     * Get the superuser associated with the organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function superuser()
    {
        return $this->hasOne(User::class, 'superuser');
    }

    /**
     * Get the users associated with the organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'orgID');
    }

    /**
     * Get the locations associated with the organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany(Location::class, 'orgID');
    }
}
