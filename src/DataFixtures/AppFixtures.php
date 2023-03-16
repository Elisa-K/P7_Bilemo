<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Product;
use Faker\Factory as Faker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');
        $clients = [];
        $products = [
            1 => [
                'name' => 'iPhone 14 Plus',
                'brand' => 'Apple',
                'price' => '1249,00 €',
                'size' => '6,7"',
                'storage' => '256GB',
                'releaseDate' => new \DateTimeImmutable('2022-10-07')
            ],
            2 => [
                'name' => 'Galaxy S23',
                'brand' => 'Samsung',
                'price' => '1599,00€',
                'size' => '6,8"',
                'storage' => '512GB',
                'releaseDate' => new \DateTimeImmutable('2023-02-17')
            ],
            3 => [
                'name' => 'Galaxy Z Fold4',
                'brand' => 'Samsung',
                'price' => '1719,00€',
                'size' => '7,6"',
                'storage' => '512GB',
                'releaseDate' => new \DateTimeImmutable('2022-08-25')
            ],
            4 => [
                'name' => 'ROG Phone 6',
                'brand' => 'Asus',
                'price' => '999,00€',
                'size' => '6,7"',
                'storage' => '512GB',
                'releaseDate' => new \DateTimeImmutable('2022-07-05')
            ],
            5 => [
                'name' => 'iPhone 14 Pro Max',
                'brand' => 'Apple',
                'price' => '2129,00€',
                'size' => '6,7"',
                'storage' => '1To',
                'releaseDate' => new \DateTimeImmutable('2022-09-16')
            ],
            6 => [
                'name' => '12T',
                'brand' => 'Xiaomi',
                'price' => '649,00€',
                'size' => '6,6"',
                'storage' => '256GB',
                'releaseDate' => new \DateTimeImmutable('2022-10-04')
            ],
            7 => [
                'name' => 'Find X5 Pro',
                'brand' => 'Oppo',
                'price' => '899,00€',
                'size' => '6,7"',
                'storage' => '256GB',
                'releaseDate' => new \DateTimeImmutable('2022-02-24')
            ],
            8 => [
                'name' => 'Reno8 Pro',
                'brand' => 'Oppo',
                'price' => '749,00€',
                'size' => '6,7"',
                'storage' => '256GB',
                'releaseDate' => new \DateTimeImmutable('2022-07-19')
            ],
            9 => [
                'name' => 'Phone (1)',
                'brand' => 'Nothing',
                'price' => '499,00€',
                'size' => '6,5"',
                'storage' => '256GB',
                'releaseDate' => new \DateTimeImmutable('2022-07-12')
            ],
            10 => [
                'name' => 'Zenfone 9',
                'brand' => 'Asus',
                'price' => '849,00€',
                'size' => '5,9"',
                'storage' => '256GB',
                'releaseDate' => new \DateTimeImmutable('2022-07-28')
            ],

        ];

        foreach ($products as $productPhone) {
            $product = new Product();
            $product->setName($productPhone['name']);
            $product->setBrand($productPhone['brand']);
            $product->setPrice($productPhone['price']);
            $product->setSize($productPhone['size']);
            $product->setStorage($productPhone['storage']);
            $product->setReleaseDate($productPhone['releaseDate']);
            $manager->persist($product);
        }

        for ($i = 0; $i < 2; $i++) {
            $client = new Client();
            $client->setName($faker->company());
            $client->setEmail("client$i@bilemo.com");
            $client->setPassword($this->userPasswordHasher->hashPassword($client, "passwordClient$i"));
            $datetime = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 year', 'now'));
            $client->setCreatedAt($datetime);
            $clients[] = $client;
            $manager->persist($client);
        }

        for ($j = 0; $j < 30; $j++) {
            $user = new User();
            $user->setFirstname($faker->firstname());
            $user->setLastname($faker->lastName());
            $user->setClient($faker->randomElement($clients));
            $manager->persist($user);
        }
        $manager->flush();
    }
}