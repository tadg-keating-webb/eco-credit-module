<?php

namespace TadgKeatingWebb\EcoCreditModule\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait SavingTrait
{
    /**
     * Define a one-to-many relationship.
     */
    public function savings(): HasMany
    {
        return $this->hasMany(Saving::class);
    }
}
