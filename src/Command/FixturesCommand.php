<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Wish;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FixturesCommand extends Command
{
    protected static $defaultName = 'app:fixtures';

    protected $entityManager;

    public function __construct(string $name = null, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Load dummy data for good DX')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $faker = \Faker\Factory::create("fr_FR");

        $categoryNames = ["Sport", "Travel & Adventure", "Human Relations", "Entertainment", "Others"];
        $categories = [];
        foreach ($categoryNames as $categoryName){
            $category = new Category();
            $category->setName($categoryName);
            $this->entityManager->persist($category);
            $categories[]=$category;
        }

        $this->entityManager->flush();

        //crée 200 wish aléatoire
        for($i=0; $i<200; $i++){

            $wish = new Wish();
            $wish->setAuthor($faker->firstName." ".$faker->lastName);
            $wish->setIsPublished($faker->boolean);
            $wish->setDescription($faker->realText());
            $wish->setDateCreated($faker->dateTimeBetween("-1 year"));
            $wish->setTitle($faker->unique()->sentence);
            $wish->setCategory($faker->randomElement($categories));

            $this->entityManager->persist($wish);

        }

        $this->entityManager->flush();

        $io->success('C\'est bon');

        return Command::SUCCESS;
    }
}
