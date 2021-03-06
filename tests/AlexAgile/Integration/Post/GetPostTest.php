<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Post;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Post\GetPostCommand;
use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\Post\PostNotFoundException;
use AlexAgile\Tests\Integration\Fixture\Post\DoctrinePostFixtureLoader;
use AlexAgile\Tests\Integration\IntegrationTestAbstract;

class GetPostTest extends IntegrationTestAbstract
{
    private const NON_EXISTING_POST_URL_SLUG = 'non-existing-post-slug';

    /**
     * @test
     */
    public function getPost_whenPostExists_shouldReturnAPostObject(): void
    {
        $getPostCommand = new GetPostCommand(DoctrinePostFixtureLoader::POST1_URL_SLUG);
        $post = $this->commandBus->handle($getPostCommand);

        $this->assertInstanceOf(Post::class, $post);
    }

    /**
     * @test
     */
    public function getPostWithCategories_whenPostExists_shouldReturnAPostObjectWithNestedCategories(): void
    {
        $getPostCommand = new GetPostCommand(DoctrinePostFixtureLoader::POST1_URL_SLUG);
        /** @var Post $post */
        $post = $this->commandBus->handle($getPostCommand);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertCount(1, $post->getCategories());
        $this->assertInstanceOf(Category::class, ($post->getCategories()[0]));
    }

    /**
     * @test
     */
    public function getPost_whenPostNotExists_shouldThrowAnException(): void
    {
        $this->expectException(PostNotFoundException::class);
        $getPostCommand = new GetPostCommand(self::NON_EXISTING_POST_URL_SLUG);
        $this->commandBus->handle($getPostCommand);
    }
}
