<?php
    Class Rooster extends Controller
    {
        public function index($search_type = null, $search_value = null, $date = null)
        {
            /*var_dump($search_type);

            var_dump($search_value);

            var_dump($date);*/

            $this->view('rooster/index');
        }
    }