<?php

namespace App\Tests\Controller\Front;

use App\Entity\Post;
use App\Repository\PostRepository;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    use ReloadDatabaseTrait;

    public function testPageBlogExist(): void
    {
        $client = static::createClient();
        $client->request('GET', '/blog');

        $this->assertResponseIsSuccessful();
    }

    public function testPageSinglePostExist(): void
    {
        $client = static::createClient();
        self::bootKernel();

        $container = static::getContainer();
        /** @var PostRepository $postRepository */
        $postRepository = $container->get(PostRepository::class);

        /** @var Post $post */
        $post = $postRepository->find(1);

        $client->request('GET', '/blog/' . $post->getSlug());

        $this->assertResponseIsSuccessful();
    }
}
