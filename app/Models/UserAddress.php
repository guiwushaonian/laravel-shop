<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    // 可填充
    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];

    protected $dates = ['last_used_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取完整的收货地址
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }
}
