<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'unix_timestamp'
    ];

    // decode the value
    public function getValueAttribute($value)
    {
        $value_decoded = json_decode($value);
        
        if ($value_decoded) {
            return $value_decoded;
        }

        return $value;
    }
}
