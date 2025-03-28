<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table    = 'cards';
    protected $fillable = [
        'name',
        'deck_id',
    ];

    public function deck()
    {
        return $this->belongsTo(Deck::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'card_id', 'id'); // Ensure foreign and local keys are correct
    }
}
