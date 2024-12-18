<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'total_price' => $this->total_price,
            'delivery_type' => $this->delivery_type,
            'payment_type' => $this->payment_type,
            'status' => $this->status,
            'status_text' => $this->status_text,
            'info' => $this->info,
            'order_date' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'products' => OrderProductResource::collection($this->whenLoaded('order_products'))
        ];
    }
} 