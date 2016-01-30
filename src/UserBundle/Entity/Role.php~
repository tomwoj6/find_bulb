<?php

namespace UserBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UserBundle\Repository\RoleRepository")
 * @ORM\Table(name="role")
 */
class Role implements RoleInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=80, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255, options={"default" = null}, nullable=true)
     * 
     */
    private $displayName;
    
    
    public function __construct($role = '')
    {
        if (0 !== strlen($role)) {
            $this->name = strtoupper($role);
        }
        $this->users = new ArrayCollection();
    }

    /**
     * @see RoleInterface
     */
    public function getRole()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function addUser($user, $addRoleToUser = true)
    {
        $this->users->add($user);
        $addRoleToUser && $user->addRole($this, false);
    }

    public function removeUser($user)
    {
        $this->users->removeElement($user);
    }
    
    public function __toString()
    {
        return sprintf('%s', $this->name);
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return Role
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
}
