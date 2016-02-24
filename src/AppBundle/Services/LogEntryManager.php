<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Decorator\EntityManagerDecorator;
use AppBundle\Entity\LogEntry;

class LogEntryManager
{
	private $entityManager;

	private $formBuilder;

	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function findAllLogEntries()
    {
    	return $this->entityManager
    		->getRepository('AppBundle:LogEntry')
    		->findAll();
    }

    public function findLogEntry($id)
    {
   		return $this->entityManager
    		->getRepository('AppBundle:LogEntry')
    		->find($id);
    }

    public function findNewestLogEntries()
    {
    	$em = $this->entityManager;

    	$query = $em->createQuery(
		    'SELECT n
		    FROM AppBundle:LogEntry n
		    ORDER BY n.date DESC'
		);

		$query->setMaxResults(15);

		return $query->execute();
		
    }

    public function findStrengthTrainingLogEntries()
    {
    	$em = $this->entityManager;

    	$query = $em->createQuery(
		    'SELECT n
		    FROM AppBundle:LogEntry n
		    WHERE n.category = :category
		    ORDER BY n.date DESC'
		)->setParameter('category', 'Strength Training');


		return $query->execute();
    }

    public function findCardioTrainingLogEntries()
    {
    	$em = $this->entityManager;

    	$query = $em->createQuery(
		    'SELECT n
		    FROM AppBundle:LogEntry n
		    WHERE n.category = :category
		    ORDER BY n.date DESC'
		)->setParameter('category', 'Cardio');


		return $query->execute();
    }

    public function findOtherTrainingLogEntries()
    {
    	$em = $this->entityManager;

    	$query = $em->createQuery(
		    'SELECT n
		    FROM AppBundle:LogEntry n
		    WHERE n.category = :category
		    ORDER BY n.date DESC'
		)->setParameter('category', 'Other');


		return $query->execute();
    }

}