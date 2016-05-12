<div class="row">
    <div class="col-xs-12">
    <?php

        /**
         * Dit is een tijdelijk werkbestand om verschillende functionaliteiten toe te voegen & testen.
         * - Thoby
         */

        /*

        $start = microtime(true);

        $this->model('ScheduleLoader');
        $this->model('ScheduleNavigator');
        $this->model('ScheduleSaver');

        $loader = new ScheduleLoader();
        $nav = new ScheduleNavigator();

        try {
            $saver = new ScheduleSaver($this->db);
        } catch (Exception $e) { echo $e->getMessage(); }

        ini_set('max_execution_time', 120);

        # Loop through all classes in a sector.
        foreach($nav->get_schedule_urls('ict-college') as $klas => $klas_url) {
            $html = file_get_contents($klas_url);
            $saver->execute($loader->format_data_to_database($loader->convert_schedule_data($html)), $klas);
        }

        # Testing the efficiency of the function:

        echo microtime(true) - $start;

        # Currently seems about up to 50% faster, using the key-indexing instead of querying the database.
        # Average 13.74s VS 21.02s over about 50 tests.

        */
    ?>

        <a id="button" class="btn btn-primary">Click me</a>
    </div>
</div>
