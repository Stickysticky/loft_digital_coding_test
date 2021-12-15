<?php 

namespace Model;

/**
 *  Class representing a journey
 */
class Journey{
    /**
     * @var Step
     */
    private $stepHead;

    /**
     * @var Step
     */
    private $stepEnd;

    /**
     * Constructor of the Journey class
     * 
     * @param Step $stepHead First Step
     * @param Step $stepEnd Last Step
     * 
     */
    public function __construct($stepHead = null, $stepEnd = null){
        $this->stepHead = $stepHead;

        if(is_null($stepEnd)){
            $this->stepEnd = $stepHead;
        } else {
            $this->stepEnd = $stepEnd;
        }
    }

    /**
     * Add a step on the end of the journey
     * 
     * @param Step $step
     */
    public function add_step(Step $step){
        if(is_null($this->stepHead)){
            $step->setStepPrevious(null);
            $this->stepHead = $step;
            $this->stepEnd = $step;
        } else if($this->stepHead->isEqual($this->stepEnd)) {
            $step->setStepPrevious($this->stepHead);
            $this->stepHead->setStepNext($step);
            $this->stepEnd = $step;
        } else {
            $this->stepEnd->setStepNext($step);
        }
    }

    /**
     * Remove a step in the journey
     * 
     * @param Step $step
     */
    public function remove_step(Step $step){
        $stepCurrent = $this->getStepHead();

        while(!is_null($stepCurrent) && !$stepCurrent->isEqual($step)){
            $stepCurrent = $stepCurrent->getStepNext();
        }

        if(!is_null($stepCurrent)){
            $stepCurrent->getStepPrevious()->setStepNext($step->getStepNext());
            $stepCurrent->getStepNext()->setStepPrevious($step->getStepPrevious());
        }
    }


    /**
     * Create a new sorted journey
     * 
     * @param Journey $journey
     * @param string $strDeparture Departure Location
     * 
     * @return Journey $journeySorted
     */
    public static function sort_journey(Journey $journey, string $strDeparture) : Journey{
        $journeySorted = new Journey();
        $stepCurrent = null;

        do{
            $stepCurrent = $journey->get_step_from_departure($strDeparture);
            if(!is_null($journeySorted->add_step($stepCurrent))){
                $strDeparture = $stepCurrent->getStrTo();
                $journeySorted->add_step($stepCurrent);
                $journey->remove_step($stepCurrent);
            }
            
        }while(!is_null($stepCurrent));
        
        return $journeySorted;
    }

    /**
     * Find a step by departure
     * 
     * @param string $strDeparture Departure Location
     * 
     * @return Step $stepSearched
     */
    public function get_step_from_departure(string $strDeparture) : Step{
        $stepCurrent = $this->getStepHead();

        while(!is_null($stepCurrent) && $stepCurrent->getStrFrom() != $strDeparture){
            $stepCurrent = $stepCurrent->getStepNext();
        }

        return $stepCurrent;
    }


    /**
     * Get the value of stepEnd
     *
     * @return  Step
     */ 
    public function getStepEnd()
    {
        return $this->stepEnd;
    }

    /**
     * Set the value of stepEnd
     *
     * @param  Step  $stepEnd
     *
     * @return  self
     */ 
    public function setStepEnd(Step $stepEnd)
    {
        $this->stepEnd = $stepEnd;

        return $this;
    }

    /**
     * Get the value of stepHead
     *
     * @return  Step
     */ 
    public function getStepHead()
    {
        return $this->stepHead;
    }

    /**
     * Set the value of stepHead
     *
     * @param  Step  $stepHead
     *
     * @return  self
     */ 
    public function setStepHead(Step $stepHead)
    {
        $this->stepHead = $stepHead;

        return $this;
    }
}


