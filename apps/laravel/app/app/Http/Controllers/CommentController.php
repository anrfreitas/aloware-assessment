<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Transformers\CommentTransformer;
use App\Services\Comment\CommentService;
use App\Exceptions\CustomExceptionHandler;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    public function getByPostId(
        CommentService $service,
        int $postId
    ): Response {
        try {
            return $this->response->array(
                $this->getAllCommentsByPostId($service, $postId)
            );
        }
        catch(\Exception $e) {
            CustomExceptionHandler::handleException($e);
        }
    }

    public function save(
        StoreCommentRequest $request,
        CommentService $service,
        int $postId
    ): Response {
        try {
            $data = $request->all();
            $service->save($postId, $data);
            return $this->response->array(
                $this->getAllCommentsByPostId($service, $postId)
            );
        }
        catch(\Exception $e) {
            CustomExceptionHandler::handleException($e);
        }
    }

    public function update(
        UpdateCommentRequest $request,
        CommentService $service,
        int $postId,
        int $commentId
    ): Response {
        try {
            $data = $request->all();
            $service->update($postId, $commentId, $data);
            return $this->response->array(
                $this->getAllCommentsByPostId($service, $postId)
            );
        }
        catch(\Exception $e) {
            CustomExceptionHandler::handleException($e);
        }
    }

    public function delete(
        CommentService $service,
        int $postId,
        int $commentId
    ): Response {
        try {
            $service->delete($postId, $commentId);
            return $this->response->array(
                $this->getAllCommentsByPostId($service, $postId)
            );
        }
        catch(\Exception $e) {
            CustomExceptionHandler::handleException($e);
        }
    }

    private function getAllCommentsByPostId(
        CommentService $service,
        int $postId
    ): array {
        $comments = $service->getByPostId($postId);
        try {
            return (new CommentTransformer())->transform($comments);
        }
        catch(\Exception $e) {
            CustomExceptionHandler::handleException($e);
        }
    }
}
