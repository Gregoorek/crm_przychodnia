<?php

namespace App\Command;

use App\Entity\Visit;
use App\Repository\VisitRepository;
use http\Env\Response;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Twig\Environment;

class NewVisitsCommand extends Command
{
    protected static $defaultName = 'app:next-visits';

    private  $visitRepository;
    private $mailer;
    private $twig;

    public function __construct(VisitRepository $visitRepository, \Swift_Mailer $mailer, Environment $twig)
    {
        parent::__construct();
        $this->visitRepository = $visitRepository;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    protected function configure()
    {
        $this->setDescription('Next visits notification');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $visits = $this->visitRepository->findNextVisit(new \DateTime());
        /**
         * @var Visit $visit
         */


        foreach ($visits as $visit){


            $message=(new \Swift_Message('hello email'))
                ->setFrom('przychodania@adres.com')
                ->setTo($visit->getPatient()->getEmail())
                ->setBody(
                    $this->twig->render('email/nextVisit.html.twig',   //przesylamy wszystko i odczytamy sobie w template co chcemy
                        ['visit'=>$visit])
                );


            $this->mailer->send($message);
        }


        $io->success(sprintf('Success send %d emails', count($visits)));

    }
}
