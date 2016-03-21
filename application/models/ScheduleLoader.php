<?php

    class ScheduleLoader
    {
        /**
         * Splits out a row into separated elements, and returns them.
         *
         * @param   object(DOMNodeList) The childNodes of a row.
         * @return  array               A formatted array of the split row.
         */
        public function split_rows($_dom_elements)
        {
            $return = array();

            foreach ($_dom_elements as $element) {
                $internalNodes = $element->getElementsByTagName('tr');

                if($internalNodes->length > 0)
                {
                    $table = array();
                    foreach ($internalNodes as $node) {
                        $table[] = $this->split_rows($node->childNodes);
                    }
                    $table['colspan'] = ($element->getAttribute('colspan') > 0) ? $element->getAttribute('colspan') : 1;
                    $return[] = $table;
                } else if($element->nodeValue != '') {
                    $return[] = $element->nodeValue;
                }
            }

            return $return;
        }

        /**
         * Converts the raw HTML into an array, which is readable.
         *
         * @param   string  The HTML of the page.
         * @return  array   The converted data in an array.
         */
        public function convert_schedule_data($_html)
        {
            $DOM = new DOMDocument;
            $DOM->loadHTML($_html);

            $relevantKeys = array(
                'dag' => 1,

                'Maandag' => 1,
                'Dinsdag' => 1,
                'Woensdag' => 1,
                'Donderdag' => 1,
                'Vrijdag' => 1
            );

            $items = $DOM->getElementsByTagName('tr');

            $table = array();
            foreach ($items as $node) {
                $fetched_nodes = $this->split_rows($node->childNodes);
                if(isset($relevantKeys[$fetched_nodes[0]]))
                    $table[] = $this->split_rows($node->childNodes);
            }
            return $table;
        }

        /**
         * Formats the exported data from the 'convert_schedule_data' function, by linking a date and timestamp to an hour.
         * The values exported by this function are suitable for database inserting.
         *
         * @param   array   Exported data from the 'convert_schedule_data' function.
         * @return  array   Formatted data in lines with their respective times and data.
         */
        public function format_data_to_database($_data)
        {
            $timestamps = array_slice($_data[0], 2);
            $timestamps[] = $this->calculate_next_timestamp($timestamps);

            $hour_data = array();

            # Loop through the day-rows:
            foreach(array_slice($_data, 1) as $day_row)
            {
                $date_today = $day_row[1];

                $hour = -1;
                # Loop through the hours:
                foreach(array_slice($day_row, 1) as $hour_row)
                {
                    if(is_array($hour_row)) {

                        # Loop through the hour-instances within an hour:
                        foreach($hour_row as $instance) {

                            # Check if the instance is an array, and isn't filled with 'non-breaking space' unicode's.
                            if(is_array($instance) && !empty(trim($instance[0], chr(0xC2).chr(0xA0)))) {

                                if(count($instance) === 3) {
                                    $instance_data = [
                                        'teacher' => $instance[0],
                                        'classroom' => $instance[1],
                                        'subject' => $instance[2]
                                    ];
                                } else if(count($instance) === 1) {
                                    $instance_data = [ 'vak' => $instance[0] ];
                                }

                                $instance_data = $instance_data + array(
                                    'date' => $date_today,
                                    'start' => $timestamps[$hour],
                                    'end' => $timestamps[$hour + $hour_row['colspan']]
                                );

                                $hour_data[] = $instance_data;
                            }
                        }

                        $hour += $hour_row['colspan'];
                    } else {
                        $hour++;
                    }
                }
            }
            return $hour_data;
        }

        /**
         * Calculate the successive timestamp by getting the most frequent time-difference out of the past timestamps,
         * and adding that onto the last given time.
         *
         * @param   array           The timestamps of the past hours.
         * @return  bool|string     The upcoming timestamp.
         */
        protected function calculate_next_timestamp($_timestamps)
        {
            $values = array();
            for($index = 1; $index < count($_timestamps); $index++)
                $values[] = strtotime($_timestamps[$index]) - strtotime($_timestamps[$index - 1]);
            $frequent_value = array_count_values($values);

            return date('H:i', strtotime($_timestamps[count($_timestamps) - 1]) + array_search(max($frequent_value), $frequent_value));
        }
    }