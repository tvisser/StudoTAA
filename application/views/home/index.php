<div class="row">
<?php

    /**
     * Dit is een tijdelijk werkbestand om verschillende functionaliteiten toe te voegen & testen.
     * - Thoby
     */

    $html = file_get_contents('http://roosters.roc-teraa.nl/rooster_uitwisseling/business-college/2P0/2016031420160415/2P02560.htm');

    # Import ScheduleLoader class.
    $this->model('ScheduleLoader');

    $loader = new ScheduleLoader();

    echo json_encode($loader->format_data_to_database($loader->convert_schedule_data($html)));

?>
</div>
