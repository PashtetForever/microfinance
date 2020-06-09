<?php

namespace App\Http\Resources;

use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'loan' => [
                'number' => $this->number,
                'sum' => $this->sum,
                'days' => $this->days,
                'percent' => $this->percent,
                'created_at' => (new Carbon($this->created_at))->format('d.m.Y H:i'),
                'deleted_at' => (new Carbon($this->deleted_at))->format('d.m.Y H:i'),
            ],
            'documents' => DocumentResource::collection($this->documents)
        ];
    }
}
