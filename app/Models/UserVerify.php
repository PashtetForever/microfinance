<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserVerify
 *
 * @package App\Models
 * @property string $code
 * @property Carbon $verify_at
 * @property int $id
 * @property string $phone
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserVerify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserVerify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserVerify query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserVerify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserVerify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserVerify wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserVerify whereVerifyAt($value)
 * @mixin \Eloquent
 */
class UserVerify extends Model
{
    public $table = 'users_verify';
    public $timestamps = false;
    public $fillable = ['code', 'phone'];

    public $casts = [
        'verify_at' => 'datetime'
    ];
}
