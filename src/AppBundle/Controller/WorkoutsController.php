<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\LogEntry;
use AppBundle\Form\Type\LogEntryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class WorkoutsController extends Controller
{
	/**
	 * @Route("/workout-log", name="app_home")
	 * @Template()
	 */
	public function showAction()
	{
		$logEntries = $this->findNewestLogEntries();

		return $this->render('workouts/show.html.twig', array(
			'logEntries' => $logEntries,
		));

		return new Response($html);
	}

	/**
	 * @Route("/workout-log/archive", name="app_archive")
	 * @Template()
	 */
	public function showAllAction()
	{
		$logEntries = $this->findAllLogEntries();

		return $this->render('workouts/archive.html.twig', array(
			'logEntries' => $logEntries,
		));

		return new Response($html);
	}

	/**
	 * @Route("/workout-log/strength-exercises", name="app_strength_sort")
	 * @Template()
	 */
	public function showStrengthAction()
	{
		$logEntries = $this->findStrengthTrainingLogEntries();

		return $this->render('workouts/strength-exercises.html.twig', array(
			'logEntries' => $logEntries,
		));

		return new Response($html);
	}

	/**
	 * @Route("/workout-log/cardio-exercises", name="app_cardio_sort")
	 * @Template()
	 */
	public function showCardioAction()
	{
		$logEntries = $this->findCardioTrainingLogEntries();

		return $this->render('workouts/cardio-exercises.html.twig', array(
			'logEntries' => $logEntries,
		));

		return new Response($html);
	}

	/**
	 * @Route("/workout-log/other-exercises", name="app_other_sort")
	 * @Template()
	 */
	public function showOtherAction()
	{
		$logEntries = $this->findOtherTrainingLogEntries();

		return $this->render('workouts/other-exercises.html.twig', array(
			'logEntries' => $logEntries,
		));

		return new Response($html);
	}

	/**
	 * @Route("/workout-log/new", name="log_entry_new")
	 * @Template()
	 */
	public function newAction(Request $request)
    {
    	$logEntry = new LogEntry();

        $form = $this->createForm(LogEntryType::class, $logEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	// ... perform some action, such as saving the task to the database
        	$em = $this->getDoctrine()->getManager();

		    $em->persist($logEntry);
		    $em->flush();

        	return $this->redirectToRoute('app_home');
    	}

        return $this->render('workouts/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
	 * @Route("/workout-log/{id}/delete", name="log_entry_delete")
	 * @Template()
	 */
    public function deleteAction($id)
    {
    	$logEntry = $this->findLogEntry($id);

	    $em = $this->getDoctrine()->getManager();
	    $em->remove($logEntry);
	    $em->flush();

	    // Redirect to the table page
	    return $this->redirectToRoute('app_home');
    }

    /**
	 * @Route("/workout-log/{id}/update", name="log_entry_edit")
	 * @Template()
	 * @Method({"POST", "GET"})
	 */
    public function editAction(Request $request, $id)
    {
    	$logEntry = $this->findLogEntry($id);
        $form = $this->createForm(LogEntryType::class, $logEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	// ... perform some action, such as saving the task to the database
        	$em = $this->getDoctrine()->getManager();

		    $em->persist($logEntry);
		    $em->flush();

        	return $this->redirectToRoute('app_home');
    	}

        return $this->render('workouts/edit.html.twig', array(
            'form' => $form->createView(),
            'logEntry' => $logEntry,
        ));
    }

    private function findLogEntry($id)
    {
   		return $this->get('log_entry.manager')
   			->findLogEntry($id);
    }

    private function findAllLogEntries()
    {
    	return $this->get('log_entry.manager')
    		->findAllLogEntries();
    }

    private function findNewestLogEntries()
    {
 		return $this->get('log_entry.manager')
 			->findNewestLogEntries();
    }

    private function findStrengthTrainingLogEntries()
    {
    	return $this->get('log_entry.manager')
    		->findStrengthTrainingLogEntries();
    }

    private function findCardioTrainingLogEntries()
    {
    	return $this->get('log_entry.manager')
    		->findCardioTrainingLogEntries();
    }

    private function findOtherTrainingLogEntries()
    {
    	return $this->get('log_entry.manager')
    		->findOtherTrainingLogEntries();
    }

}