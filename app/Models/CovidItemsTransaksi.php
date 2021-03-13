<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovidItemsTransaksi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'vaksin_id',
        'khitan_id',
        'user_id',
        'quantity',
        'total',
        'status',
        'payment_url'
    ];

    public function covid()
    {
        return $this->hasOne(covid::class, 'id', 'product_id');
    }

    public function vaksin()
    {
        return $this->hasOne(vaksin::class, 'id', 'vaksin_id');
    }


    public function khitan()
    {
        return $this->hasOne(khitan::class, 'id', 'khitan_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)
            ->getPreciseTimestamp(3);
    }
    public function getUpdatedAtAttribute($updated_at)
    {
        return Carbon::parse($updated_at)
            ->getPreciseTimestamp(3);
    }
}
