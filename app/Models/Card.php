<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Card extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded;

    protected $table = "card";


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function saveUserCard($data): bool
    {
        return DB::table('card')->insert([
            'skills' => $data['skills'],
            'gratitude' => $data['gratitude'],
            'for_what' => $data['for_what'],
            'aim' => $data['aim'],
            'description' => $data['description'],
            'photo_card' => $data['photo'],
            'link_tg' => $data['link_tg'],
            'link_vk' => $data['link_vk'],
            'photo_qr' => $data['qr'],
            'phone_number' => $data['phone_number'],
            'user_id' => $data['userId'],
            'summa' => $data['summa'],
        ]);
    }
}
