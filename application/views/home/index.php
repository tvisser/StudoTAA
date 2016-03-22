<div class="row">
    <div class="col-xs-12">
    <?php

        /**
         * Dit is een tijdelijk werkbestand om verschillende functionaliteiten toe te voegen & testen.
         * - Thoby
         */

        $this->model('ScheduleLoader');
        $this->model('ScheduleNavigator');

        $loader = new ScheduleLoader();
        $nav = new ScheduleNavigator();

        $html = file_get_contents($nav->get_schedule_urls('ict-college')['IC.14AO.a']);

        echo json_encode($loader->format_data_to_database($loader->convert_schedule_data($html)));

    ?>
    </div>
</div>
