<?php

declare(strict_types=1);

namespace App\ConsoleCommand;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class CreateUser extends Command
{
    private EntityManagerInterface $em;
    private UserPasswordEncoderInterface $encoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('user:create')
            ->setDescription('Create user')
        ;
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $username = $helper->ask($input, $output, new Question('Username: '));
        $password = $helper->ask($input, $output, new Question('Password: '));

        $user = User::signUp($username);
        $user->setPassword($this->encoder->encodePassword($user, $password));

        $this->em->persist($user);
        $this->em->flush();

        $output->writeln('<info>Done!</info>');

        return 0;
    }
}
