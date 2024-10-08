<?php

namespace TadgKeatingWebb\EcoCreditModule\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait LoanTrait
{
    /**
     * Define a one-to-many relationship.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
