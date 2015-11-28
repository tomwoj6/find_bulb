<?php
namespace FindbulbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="FindbulbBundle\Repository\CommentsRepository")
 * @ORM\Table(name="comments")
 */
class Comments
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_add", referencedColumnName="id")
     **/
    protected $userAdd;

    /**
     * @ORM\ManyToOne(targetEntity="Idea", inversedBy="comments")
     * @ORM\JoinColumn(name="idea", referencedColumnName="id")
     **/
    protected $idea;
    
    /**
     * @ORM\Column(name="text", type="string", length=5000)
     */
    private $text;

    /**
     * @ORM\OneToMany(targetEntity="Comments", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Comments", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\Column(type="datetime", nullable=true) 
     * 
     */
    protected $dateAdd;
    
    /**
     * @ORM\Column(name="active", type="boolean")
     */
    protected $active;
    
    /**
     * Constructor
     */
    
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateAdd = new \DateTime('now');
        $this->active = true;
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
     * Set text
     *
     * @param string $text
     * @return Comments
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return Comments
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
     * Set userAdd
     *
     * @param \UserBundle\Entity\User $userAdd
     * @return Comments
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
     * Set idea
     *
     * @param \FindbulbBundle\Entity\Idea $idea
     * @return Comments
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
     * Add children
     *
     * @param \FindbulbBundle\Entity\Comments $children
     * @return Comments
     */
    public function addChild(\FindbulbBundle\Entity\Comments $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \FindbulbBundle\Entity\Comments $children
     */
    public function removeChild(\FindbulbBundle\Entity\Comments $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \FindbulbBundle\Entity\Comments $parent
     * @return Comments
     */
    public function setParent(\FindbulbBundle\Entity\Comments $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \FindbulbBundle\Entity\Comments 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Comments
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
