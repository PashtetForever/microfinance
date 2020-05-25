<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmailVerify
 *
 * @property int $id
 * @property string $user_guid
 * @property string $code
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $verify_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailVerify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailVerify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailVerify query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailVerify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailVerify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailVerify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailVerify whereUserGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailVerify whereVerifyAt($value)
 * @mixin \Eloquent
 */
class EmailVerify extends Model
{
    public $table = 'emails_verify';
    public $timestamps = false;
    public $fillable = ['code', 'email', 'user_guid'];

    public $casts = [
        'verify_at' => 'datetime'
    ];
}
