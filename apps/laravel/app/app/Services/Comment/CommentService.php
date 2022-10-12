<?php

namespace App\Services\Comment;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomExceptionHandler;

/**
 * Class CommentService
 * @package App\Services\Comment
 */
class CommentService
{
    /**
     * @param int $postId
     * @return array
    */
    public function getByPostId(int $postId): array
    {
        try {
            return DB::select("SELECT * from comments WHERE post_id = $postId");
        }
        catch(HttpException $e) {
            abort($e->getStatusCode(), $e->getMessage());
        }
        catch(\Exception $e) {
            CustomExceptionHandler::handleException($e);
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
            CustomExceptionHandler::handleException($e);
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
            CustomExceptionHandler::handleException($e);
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
            CustomExceptionHandler::handleException($e);
        }
    }
}
