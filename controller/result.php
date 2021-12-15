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
    return $journey->get_array_ordonned_journey($journey, 'Fazenda São Francisco Citros, Brazil');
}


/**
 * Return the output for the journey with registered data
 * 
 * @param string $strCustomData Custom data
 * 
 * @return string strOutput
 */
function get_output_custom_journey(string $strCustomData){
    $journey = Journey::create_journey_from_input_data($strCustomData);

    return $journey->get_array_ordonned_journey($journey, 'Fazenda São Francisco Citros, Brazil');
}



if(isset($_POST['inpData']) && $_POST['inpData'] != ''){
    $strOutput = get_output_custom_journey($_POST['inpData']);
} else {
    $strOutput = get_output_journey();
}

require '../templates/result.php';