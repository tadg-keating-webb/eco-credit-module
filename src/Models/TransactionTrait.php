<?php

namespace TadgKeatingWebb\EcoCreditModule\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait TransactionTrait
{
    /**
     * Define a one-to-many relationship.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
