<?php

namespace Budget\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="Budget\Repository\TransactionRepository")
 */
class Transaction
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
     * @var float
     *
     * @ORM\Column(name="income", type="decimal", nullable=true)
     */
    private $income;

    /**
     * @var float
     *
     * @ORM\Column(name="outcome", type="decimal", nullable=true)
     */
    private $outcome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entry_time", type="datetime", nullable=false)
     */
    private $entryTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=false)
     */
    private $updateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="execution_date", type="date", nullable=true)
     */
    private $executionDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_11", type="boolean", nullable=false)
     */
    private $is11;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=1024, nullable=true)
     */
    private $note;

    /**
     * @var \Budget\Entity\TransactionType
     *
     * @ORM\ManyToOne(targetEntity="Budget\Entity\TransactionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var \Budget\Entity\Company
     *
     * @ORM\ManyToOne(targetEntity="Budget\Entity\Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company", referencedColumnName="id")
     * })
     */
    private $company;

    /**
     * @var \Budget\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Budget\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
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
     * Set income
     *
     * @param float $income
     * @return Transaction
     */
    public function setIncome($income)
    {
        $this->income = $income;
    
        return $this;
    }

    /**
     * Get income
     *
     * @return float 
     */
    public function getIncome()
    {
        return $this->income;
    }

    /**
     * Set outcome
     *
     * @param float $outcome
     * @return Transaction
     */
    public function setOutcome($outcome)
    {
        $this->outcome = $outcome;
    
        return $this;
    }

    /**
     * Get outcome
     *
     * @return float 
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * Set entryTime
     *
     * @param \DateTime $entryTime
     * @return Transaction
     */
    public function setEntryTime($entryTime)
    {
        $this->entryTime = $entryTime;
    
        return $this;
    }

    /**
     * Get entryTime
     *
     * @return \DateTime 
     */
    public function getEntryTime()
    {
        return $this->entryTime;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return Transaction
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;
    
        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set executionDate
     *
     * @param \DateTime $executionDate
     * @return Transaction
     */
    public function setExecutionDate($executionDate)
    {
        $this->executionDate = $executionDate;
    
        return $this;
    }

    /**
     * Get executionDate
     *
     * @return \DateTime 
     */
    public function getExecutionDate()
    {
        return $this->executionDate;
    }

    /**
     * Set is11
     *
     * @param boolean $is11
     * @return Transaction
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
     * Set note
     *
     * @param string $note
     * @return Transaction
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set type
     *
     * @param \Budget\Entity\TransactionType $type
     * @return Transaction
     */
    public function setType(\Budget\Entity\TransactionType $type = null)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return \Budget\Entity\TransactionType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set company
     *
     * @param \Budget\Entity\Company $company
     * @return Transaction
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
     * @param \Budget\Entity\User $user
     * @return Transaction
     */
    public function setUser(\Budget\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Budget\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}