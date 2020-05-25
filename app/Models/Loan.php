<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Loan
 *
 * @property int $id
 * @property string $loan_id
 * @property string $user_guid
 * @property string $loan_guid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Loan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereLoanGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereUserGuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Loan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Loan withoutTrashed()
 * @mixin \Eloquent
 */
class Loan extends Model
{
    use SoftDeletes;

    public $fillable = ['loan_id', 'user_guid', 'loan_guid'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
