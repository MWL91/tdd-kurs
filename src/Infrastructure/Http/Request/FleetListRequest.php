<?php

namespace Mwl91\Tdd\Infrastructure\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;

class FleetListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !!$this->user('api');
    }

    public function rules(): array
    {
        return [
        ];
    }
}