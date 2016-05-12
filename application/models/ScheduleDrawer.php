<?php

    class ScheduleDrawer
    {
        /**
         * Get the top-offset for a schedulehour-block. The returned value will include the percentage suffix.
         *
         * @param   time    The time to calculate the time for.
         * @return  string  Top-offset including the % suffix.
         */
        public static function get_top_offset($_begintime)
        {
            return ((intval(substr($_begintime, 0, 2)) * 60 + intval(substr($_begintime, 3)) - 510) / 5.1) . "%";
        }

        /**
         * Get the height of a schedulehour-block. The size will be calculated using the begin- and endtime.
         * The returned value will include the percentage suffix.
         *
         * @param   time    The time the hour starts.
         * @param   time    The time the hour ends.
         * @return  string  The calculated height, including the % suffix.
         */
        public static function get_block_height($_begintime, $_endtime)
        {
            return ((intval(substr($_endtime, 0, 2)) * 60 + intval(substr($_endtime, 3)) - (intval(substr($_begintime, 0, 2)) * 60 + intval(substr($_begintime, 3)))) / 5.1) . "%";
        }
    }