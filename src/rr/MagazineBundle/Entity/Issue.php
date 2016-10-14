<?php

namespace rr\MagazineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Issue
 *
 * @ORM\Table(name="issues")
 * @ORM\Entity(repositoryClass="rr\MagazineBundle\Entity\IssueRepository")
 */
class Issue
{
    /**
     * @var Pubblication
     * @ORM\ManyToOne(targetEntity="Pubblication", inversedBy="issue")
     * @ORM\JoinColumn(name="pubblication_id", referencedColumnName="id")
     */
    private $pubblication;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     * @Assert\Range (
     *  min = 1,
     *  minMessage = "You'll need to specify Issue 1 or higher"
     *)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="date")
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255, nullable=true)
     */
    private $cover;

    

    public function __construct()
    {
       // $this->logger = $this->get('logger');
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
     * Set number
     *
     * @param integer $number
     * @return Issue
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Issue
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set cover
     *
     * @param string $cover
     * @return Issue
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string 
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set pubblication
     *
     * @param \rr\MagazineBundle\Entity\Pubblication $pubblication
     * @return Issue
     */
    public function setPubblication(\rr\MagazineBundle\Entity\Pubblication $pubblication = null)
    {
        $this->pubblication = $pubblication;

        return $this;
    }

    /**
     * Get pubblication
     *
     * @return \rr\MagazineBundle\Entity\Pubblication 
     */
    public function getPubblication()
    {
        return $this->pubblication;
    }

    
    /**
     * @return string
     *  Relative path
     */
    protected function getUploadPath()
    {
         return 'uploads/covers';
    }


    /**
     * @return string
     *  Absolute path.
     */
    protected function getUploadAbsolutePath(){
        
        //$this->logger->info(__DIR__ );
        //$this->logger->info('test');
        //echo print (__DIR__ . '/web/' . $this->getUploadPath());
        return __DIR__ . '/../../../../web/' . $this->getUploadPath();
    }

    /**
     * Get path on disk to a cover
     *
     * @return  null|string
     *  Absolute path
     * 
     */
    public function getCoverWeb(){
        return NULL === $this->getCover()
                    ? NULL
                    : $this->getUploadPath() . '/' . $this->getCover();
    }

    /**
     * @assert\File(maxSize="1000000")
     * 
     */
    private $file;

    /**
     * Set file.
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file     */
    public function setFile(UploadedFile $file = NULL) {
        //echo print_r($file);
        $this->file = $file;
        return $this->file;
    }

    /**
     * Get file.
     * @return UploadedFile
     */
    public function getFile(){
        return $this->file;
    }

    /**
     * Upload a Cover file.
     */
    public function upload(){
        //$this->logger->info($this->getFile());
        if (NULL === $this->getFile()){
            return;
        } 
        $filename = $this->getFile()->getClientOriginalName();
        // Move the uploaded file to the target directory using original name
        $this->getFile()->move(
            $this->getUploadAbsolutePath(),
            $filename
        );
        $this->setCover($filename);
        // Cleanup.
        $this->setFile(); 

    }
}
