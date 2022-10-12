<?php

namespace App\Http\Transformers;

use App\Transformers\AbstractTransFormer;

class CommentTransformer extends AbstractTransFormer
{
    function __construct() {}

    /**
     * @param array $comments
     * @return array
     */
    public function transform(array $comments): array
    {
        $output = [];
        foreach($comments as $comment) {
            if (!$comment->parent_id)
                array_push($output, [
                    "id" => $comment->id,
                    "name" => $comment->name,
                    "message" => $comment->message,
                    "comments" => $this->transformSubComments($comment->id, $comments),
                ]);
        }
        return $output;
    }

    /**
     * @param int $parentCommentId
     * @param array $comments
     * @return array
     */
    private function transformSubComments(
        int $parentCommentId,
        array $comments
    ): array {
        $output = [];
        $filteredComments = array_filter($comments,
            function ($comment) use ($parentCommentId) {
                return $comment->parent_id == $parentCommentId;
            });

        foreach($filteredComments as $comment) {
            array_push($output, [
                "id" => $comment->id,
                "name" => $comment->name,
                "message" => $comment->message,
                "comments" => $this->transformSubComments($comment->id, $comments),
            ]);
        }
        return $output;
    }
}
