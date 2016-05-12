<?php

    class ScheduleSaver
    {
        /* @var $db Database */
        private $db;


        /**
         * ScheduleSaver constructor, localizes the database object.
         *
         * @param   Database    The database object.
         * @throws  Exception   When $_database parameter isn't a Database object.
         */
        public function __construct($_database)
        {
            if(!empty($_database) && is_a($_database, 'Database'))
                $this->db = $_database;
            else throw new Exception('Error: The $_database argument isn\'t a valid Database object.');
        }

        /**
         * Load data from the 'teachers', 'subjects' and 'classrooms' table.
         * Orders them so they're efficiently use-able.
         *
         * @param   string          The table name of the desired data (possible options: 'teachers', 'subjects' & 'classrooms'').
         * @return  array|bool      An array with the formatted data- or returned false when unable to succeed.
         */
        protected function load_database_data($_table_name)
        {
            switch($_table_name) {
                case 'teachers':
                    $queried_data = $this->db->query('SELECT `id_Teacher`, `Initials` FROM teachers', true);
                    $column_names = array(
                        'id' => 'id_Teacher',
                        'primary' => 'Initials'
                    );
                    break;

                case 'subjects':
                    $queried_data = $this->db->query('SELECT `id_Subject`, `Subjecttext` FROM subjects', true);
                    $column_names = array(
                        'id' => 'id_Subject',
                        'primary' => 'Subjecttext'
                    );
                    break;

                case 'classrooms':
                    $queried_data = $this->db->query('SELECT `id_Classroom`, `Classroomname` FROM classrooms', true);
                    $column_names = array(
                        'id' => 'id_Classroom',
                        'primary' => 'Classroomname'
                    );
                    break;

                default: return false;
            }

            if(!empty($queried_data)) {
                $formatted_values = array();
                foreach ($queried_data as $query)
                    $formatted_values[$query[$column_names['primary']]] = $query[$column_names['id']];

                return $formatted_values;
            } else return false;
        }

        /**
         * Create a new row in a specified table, using the given $_value.
         *
         * @param   string  The name of the table where the new instance should be inserted.
         * @param   string  The primary-value inserted in the table.
         */
        protected function add_table_instance($_table_name, $_value)
        {
            switch($_table_name) {
                case 'teachers':
                    $column_name = 'Initials';
                    break;

                case 'subjects':
                    $column_name = 'Subjecttext';
                    break;

                case 'classrooms':
                    $column_name = 'Classroomname';
                    break;

                case 'classes':
                    $column_name = 'Classname';
                    break;

                default: return;
            }

            $this->db->query('INSERT INTO `' . $_table_name . '` (`' . $column_name . '`) VALUES ("' . $_value . '")');
        }


        /**
         * Uses data and the class' name to save the hour-data to the database, using the right foreign keys
         * and making sure all data is correctly formatted.
         *
         * @param   array   The hour data (exported from the format_data_to_database function in the ScheduleLoader class)
         * @param   string  The name of the class, used for the query's foreign-key.
         * @return  int     The newly updated instances count (0 if no changes are detected).
         */
        
        public function execute($_hour_data, $_class_name)
        {
            $fk_teachers    = $this->load_database_data('teachers');
            $fk_subjects    = $this->load_database_data('subjects');
            $fk_classrooms  = $this->load_database_data('classrooms');

            $new_instance_count = 0;

            # Query the primary key belonging to the current class.
            $fk_class_name   = $this->db->query('SELECT `id_Class` FROM classes WHERE `Classname`="' . $_class_name . '"');
            if(empty($fk_class_name)) {
                $this->add_table_instance('classes', $_class_name);
                $fk_class_name = $this->db->query('SELECT `id_Class` FROM classes WHERE `Classname`="' . $_class_name . '"');
            }

            # Fetch hours to possibly use their primary key.
            $queried_hours = $this->db->query('SELECT * FROM hours WHERE fk_Class=' . $fk_class_name['id_Class'], true);
            if (!empty($queried_hours)) {
                $saved_hours = array();
                foreach ($queried_hours as $hour) {
                    $saved_hours
                        [$hour['Date']]
                        [$hour['Starttime']]
                        [$hour['Endtime']]
                        [(!empty($hour['fk_Subject'])) ? $hour['fk_Subject'] : 'NULL']
                        [(!empty($hour['fk_Teacher'])) ? $hour['fk_Teacher'] : 'NULL']
                        [(!empty($hour['fk_Classroom'])) ? $hour['fk_Classroom'] : 'NULL']
                        = $hour['id_Hour'];
                }
            }

            $this->db->query('DELETE FROM `hours` WHERE `fk_Class` = ' . $fk_class_name['id_Class']);

            foreach($_hour_data as $current_insert) {

                # Check if current-inserts subject is newly added.
                if(isset($current_insert['subject']) && !isset($fk_subjects[$current_insert['subject']])) {
                    echo 'Adding new subject ' . $current_insert['subject'] . '...</br>';

                    $this->add_table_instance('subjects', $current_insert['subject']);
                    $fk_subjects = $this->load_database_data('subjects');

                    echo 'Added new subject, ID: ' . $fk_subjects[$current_insert['subject']] . '</br></br>';
                }

                # Check if current-inserts teacher is newly added.
                if(isset($current_insert['teacher']) && !isset($fk_teachers[$current_insert['teacher']])) {
                    echo 'Adding new teacher ' . $current_insert['teacher'] . '...</br>';

                    $this->add_table_instance('teachers', $current_insert['teacher']);
                    $fk_teachers = $this->load_database_data('teachers');

                    echo 'Added new teacher, ID: ' . $fk_teachers[$current_insert['teacher']] . '</br></br>';
                }

                # Check if current-inserts classroom is newly added.
                if(isset($current_insert['classroom']) && !isset($fk_classrooms[$current_insert['classroom']])) {
                    echo 'Adding new classroom ' . $current_insert['classroom'] . '...</br>';

                    $this->add_table_instance('classrooms', $current_insert['classroom']);
                    $fk_classrooms = $this->load_database_data('classrooms');

                    echo 'Added new classroom, ID: ' . $fk_classrooms[$current_insert['classroom']] . '</br></br>';
                }

                $date = date('Y-m-d', strtotime($current_insert['date']));

                $key_classroom  = (!empty($current_insert['classroom'])) ? $fk_classrooms[$current_insert['classroom']] : 'NULL';
                $key_teacher    = (!empty($current_insert['teacher'])) ? $fk_teachers[$current_insert['teacher']] : 'NULL';
                $key_subject    = (!empty($current_insert['subject'])) ? $fk_subjects[$current_insert['subject']] : 'NULL';

                $primary_key = 'NULL';
                if(isset($saved_hours[$date][$current_insert['start'] . ':00'][$current_insert['end'] . ':00'][$key_subject][$key_teacher][$key_classroom]))
                    $primary_key = $saved_hours[$date][$current_insert['start'] . ':00'][$current_insert['end'] . ':00'][$key_subject][$key_teacher][$key_classroom];
                else $new_instance_count++;

                $this->db->query('INSERT INTO `hours` (`id_Hour`, `Date`, `Starttime`, `Endtime`, `fk_Class`, `fk_Teacher`, `fk_Subject`, `fk_Classroom`)
                                  VALUES (' . $primary_key . ', "' . $date . '", "' . $current_insert['start'] . '", "' . $current_insert['end'] . '", ' . $fk_class_name['id_Class'] . ', ' . $key_teacher . ', ' . $key_subject . ', ' . $key_classroom . ');');
            }
            return $new_instance_count;
        }
    }