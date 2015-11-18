<?php
namespace FindbulbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="idea_files")
 */
class IdeaFiles 
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
   
    /**
     * @ORM\ManyToOne(targetEntity="Idea")
     * @ORM\JoinColumn(name="idea", referencedColumnName="id")
     **/
    protected $idea;
    
    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;
 
 

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
     * @return IdeaFiles
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
     * Set idea
     *
     * @param \FindbulbBundle\Entity\Idea $idea
     * @return IdeaFiles
     */
    public function setIdea(\FindbulbBundle\Entity\Idea $idea = null)
    {
        $this->idea = $idea;

        return $this;
    }

    /**
     * Get idea
     *
     * @return \FindbulbBundle\Entity\Idea 
     */
    public function getIdea()
    {
        return $this->idea;
    }
}
