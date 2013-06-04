<?php

namespace Budget\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity
 */
class Company
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_11", type="integer", nullable=false)
     */
    private $is11;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Budget\Entity\TransactionType", inversedBy="company")
     * @ORM\JoinTable(name="link_user_company",
     *   joinColumns={
     *     @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Company
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
     * Set is11
     *
     * @param boolean $is11
     * @return Company
     */
    public function setIs11($is11)
    {
        $this->is11 = $is11;
    
        return $this;
    }

    /**
     * Get is11
     *
     * @return boolean 
     */
    public function getIs11()
    {
        return $this->is11;
    }

    /**
     * Add user
     *
     * @param \Budget\Entity\TransactionType $user
     * @return Company
     */
    public function addUser(\Budget\Entity\TransactionType $user)
    {
        $this->user[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param \Budget\Entity\TransactionType $user
     */
    public function removeUser(\Budget\Entity\TransactionType $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
}