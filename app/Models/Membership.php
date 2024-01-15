<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membership extends Model
{
    use HasFactory;

    /**
     * Get all of the users for the Membership
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the transactions for the Membership
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
