<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property int $loan_id
 * @property string $name
 * @property string $file_name
 * @property string|null $signed_at
 * @property int|null $sign_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereSignCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereSignedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document withoutTrashed()
 * @mixin \Eloquent
 */
class Document extends Model
{
    use SoftDeletes;

    protected $fillable = ['loan_id', 'file_name', 'name', 'sign_code', 'signed_at', 'is_hide'];

    protected $casts = [
        'signed_at' => 'datetime'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
