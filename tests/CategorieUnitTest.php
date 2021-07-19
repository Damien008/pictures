<?php

namespace App\Tests;

use App\Entity\Peinture;
use App\Entity\Categorie;
use PHPUnit\Framework\TestCase;

class CategorieUnitTest extends TestCase
{
    public function testIsTrue()
    {   
        $categorie = new Categorie();
        
        $categorie->setNom('nom')
                  ->setDescription('description')
                  ->setSlug('slug');

        $this->assertTrue($categorie->getNom() === 'nom');
        $this->assertTrue($categorie->getDescription() === 'description');
        $this->assertTrue($categorie->getSlug() === 'slug');
    }

    public function testIsFalse()
    {   
        $categorie = new Categorie();
        
        $categorie->setNom('nom')
                  ->setDescription('description')
                  ->setSlug('slug');

        $this->assertFalse($categorie->getNom() === 'false');
        $this->assertFalse($categorie->getDescription() === 'false');
        $this->assertFalse($categorie->getSlug() === 'false');
    }

    public function testIsEmpty(): void
    {   
        $categorie = new Categorie();
        
        $this->assertEmpty($categorie->getNom());
        $this->assertEmpty($categorie->getDescription());
        $this->assertEmpty($categorie->getSlug());
        $this->assertEmpty($categorie->getId());
    }

    public function testAddGetRemovePeinture()
    {
        $peinture = new Peinture();
        $categorie = new Categorie();

        $this->assertEmpty($categorie->getPeintures());

        $categorie->addPeinture($peinture);
        $this->assertContains($peinture, $categorie->getPeintures());

        $categorie->removePeinture($peinture);
        $this->assertEmpty($categorie->getPeintures());
    }
}
