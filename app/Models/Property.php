<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table    = 'properties';
    protected $fillable = [
        'card_id',
        'name',
        'value',
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
