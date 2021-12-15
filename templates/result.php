<h1>Result</h1>

<p> 
    [ <br>
    <?php foreach($strOutput as $strCity) {  ?>
        &nbsp <?= $strCity . (end($strOutput) != $strCity ? ',' : '') ?> <br>
    <?php } ?>
    ] </br>
</p>