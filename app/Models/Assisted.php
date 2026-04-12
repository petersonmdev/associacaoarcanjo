<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assisted extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'taxvat',
        'dob',
        'civil_status',
        'education_level',
        'profession',
        'jobless',
        'active',
        'life_history',
        'health_history',
        'continuous_medication',
        'voluntary_id',
        'contact_id',
        'address_id',
    ];

    protected $casts = [
        'active' => 'boolean',
        'jobless' => 'boolean',
        'continuous_medication' => 'boolean',
        'dob' => 'date',
    ];

    /**
     * Obter o voluntário responsável pelo assistido
     */
    public function voluntary(): BelongsTo
    {
        return $this->belongsTo(Voluntary::class);
    }

    /**
     * Obter os dependentes do assistido
     */
    public function dependents(): HasMany
    {
        return $this->hasMany(Dependent::class);
    }

    /**
     * Obter o endereço do assistido
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Obter o contato do assistido
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
