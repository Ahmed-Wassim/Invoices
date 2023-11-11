<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'Product_name',
        'section_id',
        'description'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function section()
    {
        return $this->belongsTo(sections::class);
    }
}
