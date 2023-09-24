<?php

namespace App\Tests\Controller\Front;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testPageCategoryExist(): void
    {
        $client = static::createClient();
        $client->request('GET', '/categories');

        $this->assertResponseIsSuccessful();
    }
}