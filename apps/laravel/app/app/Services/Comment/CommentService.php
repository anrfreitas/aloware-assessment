<?php

namespace App\Services\Comment;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class CommentService
 * @package App\Services\Comment
 */
class CommentService
{
    public function getByPostId(int $postId): void
    {
        try {
            // @TODO
        }
        catch(HttpException $e) {
            abort($e->getStatusCode(), $e->getMessage());
        }
        catch(\Exception $e) {
            $this->handleException($e);
        }
    }

    public function save(int $postId, array $data): void
    {
        try {
            // @TODO
        }
        catch(HttpException $e) {
            abort($e->getStatusCode(), $e->getMessage());
        }
        catch(\Exception $e) {
            $this->handleException($e);
        }
    }

    public function update(
        int $postId,
        int $commentId,
        array $data
    ): void
    {
        try {
            // @TODO
        }
        catch(HttpException $e) {
            abort($e->getStatusCode(), $e->getMessage());
        }
        catch(\Exception $e) {
            $this->handleException($e);
        }
    }

    public function delete(int $postId, int $commentId): void
    {
        try {
            // @TODO
        }
        catch(HttpException $e) {
            abort($e->getStatusCode(), $e->getMessage());
        }
        catch(\Exception $e) {
            $this->handleException($e);
        }
    }

    private function handleException(\Exception $e): void {
        if(env('APP_DEBUG', false)) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, $e->getMessage());
        }

        abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Unprocessable entity');
    }

}
