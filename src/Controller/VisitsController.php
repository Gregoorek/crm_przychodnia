<?php


namespace App\Controller;


use App\Entity\Visit;
use App\Form\VisitFormType;
use App\Repository\VisitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class VisitsController extends AbstractController


{
    /**
     * @return Response
     * @Route("/add-visit", name="add")
     */
    public function addVisit(EntityManagerInterface $entityManager,Request $request):Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $visit = new Visit();
        $visitForm =$this->createForm(VisitFormType::class, $visit);

        $visitForm->handleRequest($request);

        if ($visitForm->isSubmitted() && $visitForm->isValid()){

            $visit->setPatient($this->getUser());

            $endDate =clone $visit->getStartDate();


            $visit->setEndDate($endDate-> add(new \DateInterval('PT1H')));

            $entityManager->persist($visit);
            $entityManager->flush();

            return $this->redirectToRoute("list_visit");
        }

        return $this->render('Visit/add.html.twig', [
            'visitForm' => $visitForm->createView()]);
    }

    /**
     * @Route("/list-visit", name="list_visit")
     * @param VisitRepository $visitRepository
     * @param TokenInterface $token
     * @return Response
     */
    public function listVisit(VisitRepository $visitRepository):Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $visits= $visitRepository->findByPacient($this->getUser());

       return $this->render('Visit/list.html.twig',
           ['visits' => $visits]);
    }
}