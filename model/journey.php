<?php 

namespace Model;

require '../Model/Step.php';

use Model\Step;

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
            $this->stepHead = $step;
            $this->stepEnd = $step;
            $step->setStepPrevious(null);
            
        } else if($this->stepHead->isEqual($this->stepEnd)) {
            $this->stepHead->setStepNext($step);
            $this->stepEnd = $step;
            $step->setStepPrevious($this->stepHead);
            
        } else {
            $stepTmpEnd = $this->getStepEnd();
            $this->setStepEnd($step);
            $this->getStepEnd()->setStepNext(null);
            $this->getStepEnd()->setStepPrevious($stepTmpEnd);
            $this->getStepEnd()->getStepPrevious()->setStepNext($this->getStepEnd());
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
            if(!is_null($stepCurrent->getStepPrevious())){
                $stepCurrent->getStepPrevious()->setStepNext($step->getStepNext());
            } elseif (!is_null($stepCurrent->getStepNext())) {
                $this->setStepHead($stepCurrent->getStepNext());
            }

            if(!is_null($stepCurrent->getStepNext())){
                $stepCurrent->getStepNext()->setStepPrevious($step->getStepPrevious());
            } elseif (!is_null($stepCurrent->getStepPrevious())) {
                $this->setStepEnd($stepCurrent->getStepPrevious());
            }
            
            
        }
    }

    /**
     * Create a new journey from json input data
     * 
     * @param string string $strJsonData Json Data
     * 
     * @return Journey $journey
     */
    public static function create_journey_from_input_data(string $strJsonData) : Journey{
        $journey = new Journey();
        $arrJsonInput = json_decode($strJsonData);

        if(json_last_error() !== JSON_ERROR_NONE){
            return $journey;
        }
        
        foreach($arrJsonInput as $rowJsonStep){
            $stepNew = new Step($rowJsonStep->from, $rowJsonStep->to);
            $journey->add_step($stepNew);
        }

        var_dump($journey->get_array_output_journey());
        die;
        return $journey;
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
            if(!is_null($stepCurrent)){
                $strDeparture = $stepCurrent->getStrTo();
                $journeySorted->add_step($stepCurrent);
                
                $journey->remove_step($stepCurrent);
            }
            
        }while(!is_null($stepCurrent));

        
        return $journeySorted;
    }

    /**
     * Return the different steps of the journey as array
     * 
     * @return array $arrOutput
     */
    public function get_array_output_journey() : array{
        $arrOutput = array();
        
        $stepCurrent = $this->getStepHead();
        while(!is_null($stepCurrent)){
            $arrOutput[] = $stepCurrent->getStrFrom() ;
            $stepCurrent = $stepCurrent->getStepNext();
        }

        return $arrOutput;
    }

    /**
     * Find a step by departure
     * 
     * @param string $strDeparture Departure Location
     * 
     * @return Step $stepSearched
     */
    public function get_step_from_departure(string $strDeparture){
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


