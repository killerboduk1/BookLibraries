<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'borrowings' => $this->scopeBookName(self::getBorrowingId($this->borrowings)),
            'library' => $this->library->name,
        ];
    }

    public function getBorrowingId($borrowing)
    {
        $arrayId = [];
        foreach($borrowing as $borrow){
            $arrayId[] = $borrow->book_id;
        }
        return $arrayId;
    }
}
