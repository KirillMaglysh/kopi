<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Partner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $params = [
        'name',
        'photo',
    ];

    public static function insert($data): bool
    {
        return DB::table('partners')->insert([
            'name' => $data['name'],
            'photo' => $data['photo'],
        ]);
    }
}
