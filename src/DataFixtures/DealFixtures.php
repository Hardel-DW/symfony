<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Deal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DealFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++) {
            $deal = new Deal();
            $deal->setName("Deal-{$i}");
            $deal->setDescription("Description-{$i}");
            $deal->setPrice(rand(100, 1000));
            $deal->setEnable(true);

            /**
             * @var Category $category
             */
            $category = $this->getReference("category-1");
            $deal->addCategory($category);
            $manager->persist($deal);
        }

        $manager->flush();
    }
}
