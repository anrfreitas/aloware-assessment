<?php

namespace App\Helpers;

use App\Exceptions\CustomExceptionHandler;

class CommentHelper
{
    /**
     * @param array $input
     * @return bool
    */
    public static function isThirdLayerSubComment(array $input): bool {
        try {
            if (count($input) == 0)
                return false;

            if (
                $input[0]->c2_parent_id &&
                $input[0]->c3_parent_id
            ) return false;
            return true;
        }
        catch(\Exception $e) {
            CustomExceptionHandler::handleException($e);
        }
    }
}