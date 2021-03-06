<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Functional\Category;

use AlexAgile\Tests\DoctrineAwareTestTrait;
use AlexAgile\Tests\Integration\Fixture\Category\DoctrineCategoryFixtureLoader;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryTest extends WebTestCase
{
    use DoctrineAwareTestTrait;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpEntityManager();
        $this->fixturesLoader();
    }

    /**
     * @test
     */
    public function categoryPage_shouldShowCategoryPage()
    {
        $client = static::createClient();

        $client->request('GET', '/page/' . DoctrineCategoryFixtureLoader::CATEGORY_1_URL_SLUG);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Post one title', $client->getResponse()->getContent());
        $this->assertStringContainsString('Post One Description', $client->getResponse()->getContent());
        $this->assertStringContainsString('post/post-one-url-slug', $client->getResponse()->getContent());
        $this->assertStringNotContainsString('Post One Content', $client->getResponse()->getContent());

        $this->assertStringContainsString('Post two title', $client->getResponse()->getContent());
        $this->assertStringContainsString('Post Two Description', $client->getResponse()->getContent());
        $this->assertStringContainsString('post/post-two-url-slug', $client->getResponse()->getContent());
        $this->assertStringNotContainsString('Post Two Content', $client->getResponse()->getContent());
    }
}
