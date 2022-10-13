<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\CommentHelper;

class CommentHelperTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function inputing_empty_array_returns_false()
    {
        $this->assertEquals(false, CommentHelper::isThirdLayerSubComment([]));
    }

    /**
     * @test
     * @return void
     */
    public function if_none_comments_layer_exists_returns_true()
    {
        $this->assertEquals(true, CommentHelper::isThirdLayerSubComment([
            [
                'c2_parent_id' => null,
                'c3_parent_id' => null,
            ]
        ]));
    }

    /**
     * @test
     * @return void
     */
    public function if_only_second_comments_layer_exists_returns_true()
    {
        $this->assertEquals(true, CommentHelper::isThirdLayerSubComment([
            [
                'c2_parent_id' => null,
                'c3_parent_id' => 1,
            ]
        ]));
    }

    /**
     * @test
     * @return void
     */
    public function if_the_third_comments_layer_exists_returns_false()
    {
        $this->assertEquals(true, CommentHelper::isThirdLayerSubComment([
            [
                'c2_parent_id' => 1,
                'c3_parent_id' => 2,
            ]
        ]));
    }
}
