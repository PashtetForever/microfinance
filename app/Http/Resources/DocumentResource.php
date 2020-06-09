<?php

namespace App\Http\Resources;

use App\Models\Loan;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $loan = Loan::withTrashed()->findOrFail($this->loan_id);
        return [
            'path' => env('MIX_APP_URI') .  '/storage/documents/' . $loan->loan_guid . '/' . $this->file_name . '.pdf',
            'name' => $this->name,
            'smsCode' => (string)$this->sign_code,
            'date' => $this->created_at->format('d.m.Y'),
            'hide' => (string)$this->is_hide
        ];
    }
}
