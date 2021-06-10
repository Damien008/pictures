<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogpostFunctionalTest extends WebTestCase
{
    public function testShouldDisplayBlogpost(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/actualites');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Dernières actualités');
    }

    public function testShouldDisplayOneBlogpost()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/actualites/Blogpost-test');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h5', 'Blogpost test');
    }
}
