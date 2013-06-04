<?php

namespace Budget\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LinkUserCompany
 *
 * @ORM\Table(name="link_user_company")
 * @ORM\Entity
 */
class LinkUserCompany
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Budget\Entity\Company
     *
     * @ORM\ManyToOne(targetEntity="Budget\Entity\Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
     */
    private $company;

    /**
     * @var \Budget\Entity\TransactionType
     *
     * @ORM\ManyToOne(targetEntity="Budget\Entity\TransactionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set company
     *
     * @param \Budget\Entity\Company $company
     * @return LinkUserCompany
     */
    public function setCompany(\Budget\Entity\Company $company = null)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return \Budget\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set user
     *
     * @param \Budget\Entity\TransactionType $user
     * @return LinkUserCompany
     */
    public function setUser(\Budget\Entity\TransactionType $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Budget\Entity\TransactionType 
     */
    public function getUser()
    {
        return $this->user;
    }
}