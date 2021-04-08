<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $blogPost = new Blogpost();
        $datetime = new DateTime();
        $user = new User();

        $blogPost->setTitre('titre')
                 ->setCreatedAt($datetime)
                 ->setContenu('contenu')
                 ->setSlug('slug')
                 ->setUser($user);

        $this->assertTrue($blogPost->getTitre() === 'titre');
        $this->assertTrue($blogPost->getCreatedAt() === $datetime);
        $this->assertTrue($blogPost->getContenu() === 'contenu');
        $this->assertTrue($blogPost->getSlug() === 'slug');
        $this->assertTrue($blogPost->getUser() === $user);
    }

    public function testIsFalse(): void
    {
        $blogPost = new Blogpost();
        $datetime = new DateTime();
        $user = new User();

        $blogPost->setTitre('titre')
                 ->setCreatedAt($datetime)
                 ->setContenu('contenu')
                 ->setSlug('slug')
                 ->setUser($user);

        $this->assertFalse($blogPost->getTitre() === 'false');
        $this->assertFalse($blogPost->getCreatedAt() === new DateTime());
        $this->assertFalse($blogPost->getContenu() === 'false');
        $this->assertFalse($blogPost->getSlug() === 'false');
        $this->assertFalse($blogPost->getUser() === new User());
    }

    public function testIsEmpty(): void
    {
        $blogPost = new Blogpost();

        $this->assertEmpty($blogPost->getTitre());
        $this->assertEmpty($blogPost->getCreatedAt());
        $this->assertEmpty($blogPost->getContenu());
        $this->assertEmpty($blogPost->getSlug());
        $this->assertEmpty($blogPost->getUser());
    }
}
