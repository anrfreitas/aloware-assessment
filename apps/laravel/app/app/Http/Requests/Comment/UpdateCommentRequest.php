<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\AbstractRequest;

/**
 * Class UpdateCommentRequest
 * @package Api\Service\Requests\Comment
 */
class UpdateCommentRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'message' => 'required|string|max:255',
        ];
    }
}
