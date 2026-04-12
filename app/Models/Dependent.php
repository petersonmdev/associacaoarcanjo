<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dependent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parentage',
        'dob',
        'sex',
        'profession',
        'pne',
        'assisted_id'
    ];

    protected $casts = [
        'pne' => 'boolean',
        'dob' => 'date',
    ];

    /**
     * Obter o assistido (responsável) do dependente
     */
    public function assisted(): BelongsTo
    {
        return $this->belongsTo(Assisted::class);
    }
}
