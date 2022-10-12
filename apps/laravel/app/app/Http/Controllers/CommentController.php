<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Transformers\CommentTransformer;
use App\Services\Comment\CommentService;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    public function getByPostId(
        CommentTransformer $transformer,
        CommentService $service,
        int $postId
    ): Response {
        // We'll need to transform those comments later :)
        $comments = $service->getByPostId($postId);
        return $this->response->noContent();
    }

    public function save(
        StoreCommentRequest $request,
        CommentService $service,
        int $postId
    ): Response {
        $data = $request->all();
        $service->save($postId, $data);
        return $this->response->noContent();
    }

    public function update(
        UpdateCommentRequest $request,
        CommentService $service,
        int $postId,
        int $commentId
    ): Response {
        $data = $request->all();
        $service->update($postId, $commentId, $data);
        return $this->response->noContent();
    }

    public function delete(
        CommentService $service,
        int $postId,
        int $commentId
    ): Response {
        $service->delete($postId, $commentId);
        return $this->response()->noContent();
    }
}
