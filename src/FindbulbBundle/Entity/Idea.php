<?php
namespace FindbulbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="FindbulbBundle\Repository\IdeaRepository")
 * @ORM\Table(name="idea")
 */
class Idea 
{
    public function __construct() {
        $this->votes = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->dateAdd = new \DateTime('now');
        $this->active = true;
    }
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     **/
    protected $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     **/
    protected $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_add", referencedColumnName="id")
     **/
    protected $userAdd;
   
    /**
     * @ORM\Column(name="title", type="string", length=160)
     */
    protected $title;
    /**
     * @ORM\Column(name="description", type="string", length=160)
     */
    protected $description;
    
    /**
     * @ORM\Column(name="active", type="boolean")
     */
    protected $active;
    
    
    /**
     * @ORM\Column(type="datetime", nullable=true) 
     * 
     */
    protected $dateAdd;

    /**
     * @ORM\OneToMany(targetEntity="IdeaUserVotes", mappedBy="idea")
     */
    private $votes;
    
    /**
     * @ORM\OneToMany(targetEntity="Comments", mappedBy="idea")
     */
    private $comments;



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
     * Set title
     *
     * @param string $title
     * @return Idea
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Idea
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return Idea
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
     * Set category
     *
     * @param \FindbulbBundle\Entity\Category $category
     * @return Idea
     */
    public function setCategory(\FindbulbBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \FindbulbBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set type
     *
     * @param \FindbulbBundle\Entity\Type $type
     * @return Idea
     */
    public function setType(\FindbulbBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \FindbulbBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set userAdd
     *
     * @param \UserBundle\Entity\User $userAdd
     * @return Idea
     */
    public function setUserAdd(\UserBundle\Entity\User $userAdd = null)
    {
        $this->userAdd = $userAdd;

        return $this;
    }

    /**
     * Get userAdd
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUserAdd()
    {
        return $this->userAdd;
    }

    /**
     * Add votes
     *
     * @param \FindbulbBundle\Entity\IdeaUserVotes $votes
     * @return Idea
     */
    public function addVote(\FindbulbBundle\Entity\IdeaUserVotes $votes)
    {
        $this->votes[] = $votes;

        return $this;
    }

    /**
     * Remove votes
     *
     * @param \FindbulbBundle\Entity\IdeaUserVotes $votes
     */
    public function removeVote(\FindbulbBundle\Entity\IdeaUserVotes $votes)
    {
        $this->votes->removeElement($votes);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->votes;
    }
    
    public function getSumVotes(){
        $upVotes = 0;
        $downVotes = 0;
        foreach ($this->votes as $v){
            if($v->getUp() === 1){
                $upVotes++;
            }else{
                $downVotes++;
            }
        }
        $response = array(
            'up' => $upVotes,
            'down' => $downVotes
        );
        return (object)$response;
    }

    /**
     * Add comments
     *
     * @param \FindbulbBundle\Entity\Comments $comments
     * @return Idea
     */
    public function addComment(\FindbulbBundle\Entity\Comments $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \FindbulbBundle\Entity\Comments $comments
     */
    public function removeComment(\FindbulbBundle\Entity\Comments $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }
    
    
    

    /**
     * Set active
     *
     * @param boolean $active
     * @return Idea
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
}
