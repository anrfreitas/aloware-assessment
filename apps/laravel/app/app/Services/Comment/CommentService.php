<?php

namespace App\Services\Comment;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomExceptionHandler;
use Carbon\Carbon;

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

    /**
     * @param int $postId
     * @param array $data
     * @return array
    */
    public function save(int $postId, array $data): void
    {
        try {
            if(
                isset($data['parentId']) &&
                !$this->allowedToComment($postId, $data['parentId'])
            ) {
                abort(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    'Sub-comments are up to the 3rd layer only (3 layers from the root comment)'
                );
            }

            $insertData = [
                'post_id' => $postId,
                'parent_id' => isset($data['parentId']) ? $data['parentId'] : null,
                'name' => $data['name'],
                'message' => $data['message'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            if(!DB::table('comments')->insert($insertData))
                abort(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    'Failed to create comment'
                );
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
            if(
                !DB::table('comments')->where([
                    ['post_id', $postId],
                    ['id', $commentId],
                ])->update([
                    'message' => $data['message']
                ])
            )
                abort(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    'Failed to delete comment'
                );
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
            if(
                !DB::table('comments')->where([
                    ['post_id', $postId],
                    ['id', $commentId],
                ])->delete()
            )
                abort(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    'Failed to delete comment'
                );
        }
        catch(HttpException $e) {
            abort($e->getStatusCode(), $e->getMessage());
        }
        catch(\Exception $e) {
            CustomExceptionHandler::handleException($e);
        }
    }

    private function allowedToComment($postId, $parentId) {
        $allowed = DB::select("
            SELECT
                c1.parent_id as 'c1_parent_id',
                c2.parent_id as 'c2_parent_id'
            FROM comments c2
            LEFT JOIN comments c1 on c1.id = c2.parent_id
            WHERE
                c2.post_id = $postId AND
                c2.id = $parentId
                limit 1;
        ");

        if(
            count($allowed) > 0 &&
            $allowed[0]->c1_parent_id &&
            $allowed[0]->c2_parent_id
        ) return false;
        return true;
    }
}
