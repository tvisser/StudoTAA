<?php

	class Database
	{
		protected $connection;

        /**
        * Constants containing the database credentials.
        */
        const HOST       =   "localhost";
        const USERNAME   =   "root";
        const PASSWORD   =   "";
        const DB_NAME    =   "studotaa";
        
        /**
        * Database constructor, establishes connection.
        * with given login credentials.
        */
        public function __construct() {
            $this->connection = new mysqli($this::HOST, $this::USERNAME, $this::PASSWORD, $this::DB_NAME);
        }
        
        /**
        * Returns connection-variable.
        *
        * @return   mysqli      Database connection
        */
        public function get_connection() {
            return $this->connection;
        }
        
        /**
        * Escapes special characters in a string for use in an SQL statement.
        *
        * @param    string      String you wish to make secure
        * @return   string      SQL-secure string
        */
        public function safe_string($_string) {
            return $this->connection->real_escape_string($_string);
        }
        
        /**
        * Executes query to the database, returns result.
        *
        * @param    string      The query you wish to execute
        * @param    bool        The return value, automaticly set to false
        * @return   array       Query result, if any.
        */
        public function query($_query, $_return_array = false) {
            if(!empty($_query)) {
                if ($this->connection->connect_errno) {
                    printf('<div class="alert alert-danger"><strong>Database error: </strong>%s</div>', $this->connection->connect_error);
                    exit();
                }
                if ($result = $this->connection->query($_query, MYSQLI_USE_RESULT)) {
                    $result_values = array();
                    if(is_bool($result)) {
                        return $result;   
                    }
                    while($row = $result->fetch_assoc()) {
                       $result_values[] = $row;
                    }
                }
                
                if(!empty($result_values))
                    return ((count($result_values) > 1 || $_return_array == true) ? $result_values : $result_values[0]);
            }
            return null;
        }
    }