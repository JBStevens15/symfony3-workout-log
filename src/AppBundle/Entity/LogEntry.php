<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="logEntry")
 * @ORM\HasLifecycleCallbacks
 */
class LogEntry
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;

	/**
     * @ORM\Column(type="datetime", name="posted_at")
     */
	protected $date;

	/**
     * @ORM\Column(type="string", length=100)
     */
	protected $exerciseName;

	/**
     * @ORM\Column(type="string", length=100)
     */
	protected $weight;

	/**
     * @ORM\Column(type="integer")
     */
	protected $sets;

	/**
     * @ORM\Column(type="string", length=100)
     */
	protected $reps;

	/**
     * @Assert\Valid()
     * @ORM\Column
     */
    protected $category;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogEntry
     */
    public function setDate()
    {
        $this->date = new \DateTime("now");

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set exerciseName
     *
     * @param string $exerciseName
     *
     * @return LogEntry
     */
    public function setExerciseName($exerciseName)
    {
        $this->exerciseName = $exerciseName;

        return $this;
    }

    /**
     * Get exerciseName
     *
     * @return string
     */
    public function getExerciseName()
    {
        return $this->exerciseName;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return LogEntry
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set reps
     *
     * @param string $reps
     *
     * @return LogEntry
     */
    public function setReps($reps)
    {
        $this->reps = $reps;

        return $this;
    }

    /**
     * Get reps
     *
     * @return string
     */
    public function getReps()
    {
        return $this->reps;
    }

    /**
     * Set sets
     *
     * @param integer $sets
     *
     * @return LogEntry
     */
    public function setSets($sets)
    {
        $this->sets = $sets;

        return $this;
    }

    /**
     * Get sets
     *
     * @return integer
     */
    public function getSets()
    {
        return $this->sets;
    }

    /**
     * @ORM\PrePersist
     */
   	public function prePersist()
   	{
   		$this->date = new \DateTime();
   	}

   	public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}
