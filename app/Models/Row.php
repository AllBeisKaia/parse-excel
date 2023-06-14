<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public static function forIndex()
    {
        return static::query()->orderBy('id')->paginate(45);
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('h:m d.m.Y', strtotime($value)),
        );
    }

}
