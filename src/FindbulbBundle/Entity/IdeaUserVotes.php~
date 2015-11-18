<?php
namespace FindbulbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="FindbulbBundle\Repository\IdeaUserVotesRepository")
 * @ORM\Table(name="idea_user_votes")
 */
class IdeaUserVotes{

    function __construct() {
        $this->up = 0;
        $this->down = 0;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
   
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     **/
    protected $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Idea", inversedBy="votes")
     * @ORM\JoinColumn(name="idea", referencedColumnName="id")
     **/
    protected $idea;
    
    /**
     * @ORM\Column(name="up", type="integer")
     */
    private $up;
    /**
     * @ORM\Column(name="down", type="integer")
     */
    private $down;
 

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
     * Set up
     *
     * @param integer $up
     * @return IdeaUserVotes
     */
    public function setUp($up)
    {
        $this->up = $up;

        return $this;
    }

    /**
     * Get up
     *
     * @return integer 
     */
    public function getUp()
    {
        return $this->up;
    }

    /**
     * Set down
     *
     * @param integer $down
     * @return IdeaUserVotes
     */
    public function setDown($down)
    {
        $this->down = $down;

        return $this;
    }

    /**
     * Get down
     *
     * @return integer 
     */
    public function getDown()
    {
        return $this->down;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return IdeaUserVotes
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

    /**
     * Set idea
     *
     * @param \FindbulbBundle\Entity\Idea $idea
     * @return IdeaUserVotes
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
