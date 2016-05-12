<?php
    Class Rooster extends Controller
    {
        public function index($_search_type = null, $_search_value = null, $_date = null)
        {

            if(empty($_search_type) || empty($_search_value)) {

                // TODO: Handle invalid requests.

                die("Invalid request: rooster.php.");

            }

            switch($_search_type) {
                case "klas":
                    $query_result = $this->db->query("SELECT * FROM `classes` WHERE `Classname`='$_search_value';");
                    if(!empty($query_result)) {
                        $search_foreign_key = $query_result['id_Class'];
                        $search_column_name = 'fk_Class';
                    } else $this->invalid_search();
                    break;

                case "lokaal":
                    $query_result = $this->db->query("SELECT * FROM `classrooms` WHERE `Classroomname`='$_search_value';");
                    if(!empty($query_result)) {
                        $search_foreign_key = $query_result['id_Classroom'];
                        $search_column_name = 'fk_Classroom';
                    } else $this->invalid_search();
                    break;

                case "docent":
                    $query_result = $this->db->query("SELECT * FROM `teachers` WHERE `Initials`='$_search_value';");
                    if(!empty($query_result)) {
                        $search_foreign_key = $query_result['id_Teacher'];
                        $search_column_name = 'fk_Teacher';
                    } else $this->invalid_search();
                    break;

                case "rfid":

                    // TODO: Add RFID search.
                    die("TODO: RFID");

                    break;

                default:
                    // TODO: Proper function for displaying the search-type isn't valid.
                    $this->invalid_search();
                    break;
            }

            # Date isn't given- taking today's date.
            if(empty($_date))
                $requested_date = time();

            # Date is given & valid- taking given date.
            else if(!empty($_date) && strtotime($_date) != false)
                $requested_date = strtotime($_date);

            # Date is given & invalid- returning to today's date.
            else die(header("Location: /rooster/$_search_type/$_search_value"));


            $day_selection = ( date('w', $requested_date) < 6 ) ? 'this' : 'next';
            $start_date = strtotime("Monday $day_selection week", $requested_date);

            $day_data = array();

            for($day_loop = 0; $day_loop < 5; $day_loop++) {
                $date = date("Y-m-d", strtotime("+$day_loop days", $start_date));
                $day_data[$date] = $this->db->query("SELECT * FROM `hours`, `classes`, `classrooms`, `subjects`, `teachers` WHERE
                                      `hours`.`fk_Class` = `classes`.`id_Class` AND `hours`.`fk_Teacher` = `teachers`.`id_Teacher` AND
                                      `hours`.`fk_Subject` = `subjects`.`id_Subject` AND `hours`.`fk_Classroom` = `classrooms`.`id_Classroom` AND
                                      `Date`='$date' AND `$search_column_name` = '$search_foreign_key';");
            }

            $this->view('rooster/index', [
                'day_data' => $day_data
            ]);
        }

        private function invalid_search()
        {
            // TODO: Invalid search notification.
            die("Invalid search-argument");
        }
    }