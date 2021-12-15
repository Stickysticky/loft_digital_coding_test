<?php 

namespace Model;

/**
 *  Class representing a journey
 */
class Step{

    /**
     * @var string
     */
    private $strFrom;

    /**
     * @var string
     */
    private $strTo;

    /**
     * @var Step
     */
    private $stepNext;

    /**
     * @var Step
     */
    private $stepPrevious;

    /**
     * Constructor of the Step class
     * 
     * @param string $strFrom
     * @param string $strTo
     * @param Step $stepPrevious
     * @param Step $stepNext
     * 
     */
    public function __construct(string $strFrom = '', string $strTo = '', Step $stepPrevious = null, Step $stepNext = null){
        $this->strFrom = $strFrom;
        $this->strTo = $strTo;
        $this->stepPrevious = $stepPrevious;
        $this->stepNext = $stepNext;
        
    }


    /**
     * Get the value of strTo
     *
     * @return  string
     */ 
    public function getStrTo()
    {
        return $this->strTo;
    }

    /**
     * Set the value of strTo
     *
     * @param  string  $strTo
     *
     * @return  self
     */ 
    public function setStrTo(string $strTo)
    {
        $this->strTo = $strTo;

        return $this;
    }

    /**
     * Get the value of strFrom
     *
     * @return  string
     */ 
    public function getStrFrom()
    {
        return $this->strFrom;
    }

    /**
     * Set the value of strFrom
     *
     * @param  string  $strFrom
     *
     * @return  self
     */ 
    public function setStrFrom(string $strFrom)
    {
        $this->strFrom = $strFrom;

        return $this;
    }

    /**
     * Check if a step is equal to another one
     * 
     * @param Step $step
     * 
     * @return boolean True if equal, false otherwise
     */
    public function isEqual (Step $step) : bool {
        return $this->strFrom == $step->getStrFrom() && $this->strTo == $this->getStrTo();
    }

    /**
     * Get the value of stepNext
     *
     * @return  Step
     */ 
    public function getStepNext()
    {
        return $this->stepNext;
    }

    /**
     * Set the value of stepNext
     *
     * @param  Step  $stepNext
     *
     * @return  self
     */ 
    public function setStepNext(?Step $stepNext)
    {
        $this->stepNext = $stepNext;

        return $this;
    }

    /**
     * Get the value of stepPrevious
     *
     * @return  Step
     */ 
    public function getStepPrevious()
    {
        return $this->stepPrevious;
    }

    /**
     * Set the value of stepPrevious
     *
     * @param  Step  $stepPrevious
     *
     * @return  self
     */ 
    public function setStepPrevious(?Step $stepPrevious)
    {
        $this->stepPrevious = $stepPrevious;

        return $this;
    }
}


