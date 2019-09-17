<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Post;

use AlexAgile\Domain\ValueObject\UrlSlug;

interface PostRepositoryInterface
{
    /**
     * @throws PostNotFoundException
     */
    public function find(PostId $postId):? Post;

    /**
     * @throws PostNotFoundException
     */
    public function findByUrlSlug(UrlSlug $urlSlug):? Post;

    /** @return Post[] */
    public function findAll(): array;

    /** @return Post[] */
    public function findAllEnabledOrderedByOrder(): array;
}
