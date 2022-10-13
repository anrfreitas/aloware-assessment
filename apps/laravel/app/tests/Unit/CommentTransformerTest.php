<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Http\Transformers\CommentTransformer;

class CommentTransformerTest extends TestCase
{

    private $mockedCommentsData = [];

    private $firstLayerCommentId = 1;
    private $secondLayerCommentId = 2;
    private $thirdLayerCommentId = 3;

    protected function setUp(): void
    {
        $this->mockedCommentsData = [
            [
                'id' => $this->firstLayerCommentId,
                'post_id' => 1,
                'parent_id' => null,
                'name' => 'andre',
                'message' => 'root comment'
            ],
            [
                'id' => $this->secondLayerCommentId,
                'post_id' => 1,
                'parent_id' => $this->firstLayerCommentId,
                'name' => 'maxim',
                'message' => 'second layer comment'
            ],
            [
                'id' => $this->thirdLayerCommentId,
                'post_id' => 1,
                'parent_id' => $this->secondLayerCommentId,
                'name' => 'mark',
                'message' => 'third layer comment'
            ],
        ];
    }

    /**
     * @test
     * @return void
     */
    public function first_layer_comment_matches()
    {
        $transformedData = (new CommentTransformer)
            ->transform($this->arrayToObject($this->mockedCommentsData));
        $transformedId = $transformedData[0]['id'];
        $this->assertEquals($this->firstLayerCommentId, $transformedId);
    }

    /**
     * @test
     * @return void
     */
    public function second_layer_comment_matches()
    {
        $transformedData = (new CommentTransformer)
            ->transform($this->arrayToObject($this->mockedCommentsData));
        $transformedId = $transformedData[0]['comments']['0']['id'];
        $this->assertEquals($this->secondLayerCommentId, $transformedId);
    }

    /**
     * @test
     * @return void
     */
    public function third_layer_comment_matches()
    {
        $transformedData = (new CommentTransformer)
            ->transform($this->arrayToObject($this->mockedCommentsData));
        $transformedId = $transformedData[0]['comments'][0]['comments'][0]['id'];
        $this->assertEquals($this->thirdLayerCommentId, $transformedId);
    }

    private function arrayToObject($array) {
        return json_decode(json_encode($array), FALSE);
    }
}
