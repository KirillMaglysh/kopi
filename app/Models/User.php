<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

define('_ADMIN_', 7);

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $info = [
        'tg_link',
        'vk_link',
        'qr_photo',
        'self_photo'
    ];

    protected $skill_names = [];
    protected $skill_prices = [];
    public $dreamersId = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'skills' => 'array',
        'dreamersId' => 'array'
    ];

    public static function updateUserInfo($data): bool
    {
        return DB::table('users')->where('id', $data['userId'])->update([
            'tg_link' => $data['tg_link'],
            'vk_link' => $data['vk_link'],
            'self_photo' => $data['self_photo'],
            'qr_photo' => $data['qr_photo'],
            'skill_names' => $data['skill_names'],
            'skill_prices' => $data['skill_prices'],
        ]);
    }
}
