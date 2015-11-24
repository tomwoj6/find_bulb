<?php
namespace FindbulbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="idea_history")
 */
class IdeaHistory
{
    function __construct() {
        $this->dateAdd = new \DateTime('now');
    }

    
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
     * @ORM\Column(name="action", type="string")
     */
    protected $action;
    
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     **/
    protected $user;

    /**
     * @ORM\Column(type="datetime", nullable=true) 
     * 
     */
    protected $dateAdd;

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
     * Set action
     *
     * @param string $action
     * @return IdeaHistory
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return IdeaHistory
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return \DateTime 
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Set idea
     *
     * @param \FindbulbBundle\Entity\Idea $idea
     * @return IdeaHistory
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

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return IdeaHistory
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
