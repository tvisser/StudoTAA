<div class="row">
    <div class="col-xs-12">
    <?php

        /**
         * Dit is een tijdelijk werkbestand om verschillende functionaliteiten toe te voegen & testen.
         * - Thoby
         */

        $html = file_get_contents('http://roosters.roc-teraa.nl/rooster_uitwisseling/ict-college/2P0/2016022920160422/2P02527.htm');

        # Import ScheduleLoader class.
        $this->model('ScheduleLoader');

        $loader = new ScheduleLoader();

        echo json_encode($loader->format_data_to_database($loader->convert_schedule_data($html)));

    ?>
    </div>
</div>
