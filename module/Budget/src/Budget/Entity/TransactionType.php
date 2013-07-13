<?php

namespace Budget\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransactionType
 *
 * @ORM\Table(name="transaction_type")
 * @ORM\Entity(repositoryClass="Budget\Repository\TransactiontypeRepository")
 */
class TransactionType  implements BudgetEntityInterface
{
	const INCOME_TYPE = 0;
	const OUTCOME_TYPE = 1;
	
	
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_11", type="boolean", nullable=false)
     */
    private $is11;
	
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_tax_resolver", type="boolean", nullable=false)
     */
    private $isTaxResolver;

    /**
     * @var boolean
     *
     * @ORM\Column(name="auto_resolve_tax", type="boolean", nullable=false)
     */
    private $resolveTaxAutomatically;

    /**
     * Constructor
     */
    public function __construct()
    {
		
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
     * @return TransactionType
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
     * Set type
     *
     * @param boolean $type
     * @return TransactionType
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set is11
     *
     * @param boolean $is11
     * @return TransactionType
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
     * Set resolveTaxAutomatically
     *
     * @param boolean $value
     * @return TransactionType
     */
    public function setResolveTaxAutomatically($value)
    {
        $this->resolveTaxAutomatically = $value;
    
        return $this;
    }
	
    /**
     * Get resolveTaxAutomatically
     *
     * @return boolean 
     */
    public function getResolveTaxAutomatically()
    {
        return $this->resolveTaxAutomatically;
    }

	/**
     * Set isTaxResolver
     *
     * @param boolean $val
     * @return TransactionType
     */
    public function setIsTaxResolver($val)
    {
        $this->isTaxResolver = $val;
    
        return $this;
    }

    /**
     * Get isTaxResolver
     *
     * @return boolean 
     */
    public function getIsTaxResolver()
    {
        return $this->isTaxResolver;
    }
}