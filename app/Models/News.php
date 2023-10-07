<?php

namespace App\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class News extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $params = [
        'name',
        'short_desk',
        'long_desk',
        'photo',
    ];

    public static function insertNews($data): bool
    {
        return DB::table('news')->insert([
            'name' => $data['name'],
            'short_desk' => $data['short_desk'],
            'long_desk' => $data['long_desk'],
            'photo' => $data['photo'],
            'created_at'=> $data['date']
        ]);
    }

    public static function updateNewsInfo($data): bool
    {
        return DB::table('news')->where('id', $data['news_id'])->update([
            'name' => $data['name'],
            'short_desk' => $data['short_desk'],
            'long_desk' => $data['long_desk'],
            'photo' => $data['photo'],
            'created_at'=> $data['date']
        ]);
    }
}
