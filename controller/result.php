<?php

require '../Model/Journey.php';

use Model\Journey;

/**
 * Return the output for the journey with registered data
 * 
 * @return string strOutput
 */
function get_output_journey(){
    $strJsonData = file_get_contents('../data/input.json');
    $journey = Journey::create_journey_from_input_data($strJsonData);
    $journeySorted = Journey::sort_journey($journey, 'Fazenda São Francisco Citros, Brazil');

    return $journeySorted.get_output_journey();
}


/**
 * Return the output for the journey with registered data
 * 
 * @param string $strCustomData Custom data
 * 
 * @return string strOutput
 */
function get_output_custom_journey(string $strCustomData){
    $strJsonData = json_decode($strCustomData);
    $journey = Journey::create_journey_from_input_data($strJsonData);
    $journeySorted = Journey::sort_journey($journey, 'Fazenda São Francisco Citros, Brazil');

    return $journeySorted.get_output_journey();
}



if(isset($_POST['inpData']) && $_POST['inpData'] != ''){
    $strOutput = get_output_custom_journey($_POST['inpData']);
} else {
    $strOutput = get_output_journey();
}

require '../templates/result.php';