<div class="row">
    <div class="col-xs-12">
    <?php

        /**
         * Dit is een tijdelijk werkbestand om verschillende functionaliteiten toe te voegen & testen.
         * - Thoby
         */

        $this->model('ScheduleLoader');
        $this->model('ScheduleNavigator');
        $this->model('ScheduleSaver');

        $loader = new ScheduleLoader();
        $nav = new ScheduleNavigator();

        try {
            $saver = new ScheduleSaver($this->db);
        } catch (Exception $e) { echo $e->getMessage(); }

        $html = file_get_contents($nav->get_schedule_urls('ict-college')['IC.14AO.a']);

        $saver->execute($loader->format_data_to_database($loader->convert_schedule_data($html)));

        //var_dump($saver->load_database_data('teachers'));



    ?>
    </div>
</div>
