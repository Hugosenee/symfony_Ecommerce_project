<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach(['Tee-Shirt', 'Pull', 'Pantalon', 'Short', 'Chaussettes', 'Bonnet', 'Bijoux', 'Gants', 'Pantalon', 'Casquettes'] as $name) {
            $category = new Category();
            $category->setName($name);
            $category->setImageUrl('https://www.fatherandsons.fr/media/cache/catalog/product/imp/ort/cropped/600x844/t-shirt-homme-slim-uni-noir-01110261_06-pa.jpg');
            $manager->persist($category);
        }

        $manager->flush();

        $CategoriesRepository = $manager->getRepository(Category::class);
        $categorys = $CategoriesRepository->findAll();

        for ($i = 1; $i <= 200; $i++) {
            $product = new Product();
            $product->setName('Article' . $i);
            $product->setPrice(rand(20,250));
            $product->setImageUrl('https://img01.ztat.net/article/spp-media-p1/e2ded40bbdcf452981c7ee249420495d/080d21a95a224d89abb0aec66c3fa1d2.jpg?imwidth=1800&filter=packshot');
            $product->setDescription('Cet article ' . $i . 'est un super produit de qualité');
            $product->setStock(rand(0,50));
            $product->setCategory($categorys[rand(0, count($categorys) - 1)]);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
