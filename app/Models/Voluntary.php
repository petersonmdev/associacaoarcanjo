<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voluntary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'contact_id',
        'name',
        'email',
        'taxvat',
        'dob',
        'driving',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'driving' => 'boolean',
        'dob' => 'date',
    ];

    /**
     * Obter o usuário associado ao voluntário
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obter os assistidos responsáveis por este voluntário
     */
    public function assisted(): HasMany
    {
        return $this->hasMany(Assisted::class);
    }

    /**
     * Obter o endereço do voluntário
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Obter o contato do voluntário
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
