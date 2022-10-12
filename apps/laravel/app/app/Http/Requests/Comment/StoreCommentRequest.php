<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\AbstractRequest;

/**
 * Class StoreCommentRequest
 * @package Api\Service\Requests\Comment
 */
class StoreCommentRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'message' => 'required|string|max:255',
        ];
    }
}
