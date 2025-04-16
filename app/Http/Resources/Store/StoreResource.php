<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\StoreOwnerResource;
use App\Http\Resources\User\CustomerResource;
use App\Http\Resources\Category\CategoryResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subdomain' => $this->subdomain,
            'domain' => $this->domain,
            'logo' => $this->logo,
            'description' => $this->description,
            'type' => $this->type,
            'status' => $this->status,
            'storeowner' => new StoreOwnerResource($this->whenLoaded('storeowner')),
            'customers' => CustomerResource::collection($this->whenLoaded('customers')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
