<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    const NUMBER_CATEGORY = 3;
    const NUMBER_PRODUCT = 20;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));

        for ($i = 0; $i < self::NUMBER_CATEGORY; $i++) {
            $category = new Category();
            $category->setName(ucfirst($faker->category));
            $manager->persist($category);
        }

        $manager->flush();
        
        for($i = 0; $i < self::NUMBER_PRODUCT; $i++) {
            $product = new Product();
            $product->setName($faker->productName);
            $product->setPrice($faker->numberBetween(100, 1000));
            $product->setDescription($faker->paragraphs(3, true));
            $randomCategoryId = rand(1, self::NUMBER_CATEGORY);
            // dd($randomCategoryId);
            $randomCategory = $manager->getRepository(Category::class)->find($randomCategoryId);
            $product->setCategory($randomCategory);
            $manager->persist($product);
        }
        
        $manager->flush();
    }
}
