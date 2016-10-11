<?php

namespace rr\MagazineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Pubblication
 *
 * @ORM\Table(name="pubblications")
 * @ORM\Entity(repositoryClass="rr\MagazineBundle\Entity\PubblicationRepository")
 */
class Pubblication
{
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="pubblication")
     */

    private $issues;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    public function __construct() {
        $this->issues = new ArrayCollection();
    }


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
     * Set name
     *
     * @param string $name
     * @return Pubblication
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add issues
     *
     * @param \rr\MagazineBundle\Entity\Issue $issues
     * @return Pubblication
     */
    public function addIssue(\rr\MagazineBundle\Entity\Issue $issues)
    {
        $this->issues[] = $issues;

        return $this;
    }

    /**
     * Remove issues
     *
     * @param \rr\MagazineBundle\Entity\Issue $issues
     */
    public function removeIssue(\rr\MagazineBundle\Entity\Issue $issues)
    {
        $this->issues->removeElement($issues);
    }

    /**
     * Get issues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * Render a Publication as a string.
     * 
     * @return string
     */

    public function __toString(){
        return $this->getName();
    }
}
