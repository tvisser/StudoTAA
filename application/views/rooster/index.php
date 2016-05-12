<div class="row">
    <div class="col-xs-12" style="padding: 0px;">
        <p class="swipe-header visible-xs col-xs-8 col-xs-offset-2">
            <i class="fa fa-arrow-left"></i>&nbsp; Swipe over het rooster &nbsp;<i class="fa fa-arrow-right"></i>
        </p>
        <div class="box box-default box-solid">
            <div class="box-header with-border">

                <h3 class="box-title"><i class="fa fa-file-text"></i>&nbsp; Rooster van IC.14AO.a</h3>

            </div>
            <div class="box-body">

                <style>
                    ul.clearfix {
                        list-style: none;
                        padding: 0px;
                        height: 620px;
                        box-shadow: 0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
                    }

                    ul.clearfix li {
                        float: left;
                        height: 100%;
                        padding-bottom: 22px;
                        text-align: center;
                    }

                    ul.clearfix li:nth-child(odd) {
                        background-color: white;
                    }

                    ul.clearfix li:nth-child(even) {
                        background-color: #f0f0f0;
                    }

                    @media screen and (min-width: 768px) {
                        ul.clearfix li {
                            width: 20% !important;
                        }

                        ul.clearfix {
                            transform: translateZ(0px) translateX(0px) !important;
                            width: initial !important;
                        }

                        .frame.oneperframe {
                            overflow: visible !important;
                        }
                    }

                    @media screen and (max-width: 768px) {
                        ul.clearfix li {
                            width: calc(100vw - 182px);
                        }
                    }

                    .clearfix:before, .clearfix:after {
                        content: " ";
                        display: table;
                    }

                    ul.clearfix li .sh-header {
                        border-right: 1px solid #c0c0c0;
                        border-left: 1px solid #e2e2e2;
                    }

                    ul.clearfix li:nth-child(1) .sh-header {
                        border-radius: 5px 0 0 0;
                        border-left: 1px solid darkgrey;
                    }

                    ul.clearfix li:nth-child(5) .sh-header {
                        border-radius: 0 5px 0 0;
                        border-right: 1px solid darkgrey;
                    }

                    .sh-header {
                        height: 22px;
                        background-color: #f1f1f1;
                        border-bottom: 2px solid darkgrey;
                    }

                    .sh-container {
                        padding-top: 20px;
                        position: relative;
                        height: 100%;
                    }

                    .sh {
                        border-bottom: 2px grey;
                        border-radius: 5px;
                        width: 96%;
                        margin: 0 2%;
                        position: absolute;

                        cursor: pointer;

                        overflow: hidden;
                    }

                    .sh h3 {
                        margin-top: 0.2em;
                        margin-bottom: -5px;
                        font-weight: 700;
                    }

                    .sh h4 {
                        margin-top: 0.2em;
                        margin-bottom: 1em;
                    }

                    .sh-default {
                        /*background-color: #536dfe;*/
                        background-color: lightgrey;
                        border-bottom: 2px solid grey;
                    }

                    .fab.fab-search,
                    .fab.fab-navigate {
                        pointer-events: none;
                        box-shadow: none;
                        font-size: 0%;
                        left: 26px;
                        bottom: 24px;
                    }

                    .active .fab-search,
                    .active .fab-navigate {
                        pointer-events: auto;
                        box-shadow: 0 10px 20px rgba(0,0,0,.19),0 6px 6px rgba(0,0,0,.23);
                        font-size: inherit;
                        left: 20px;
                        bottom: 20px;
                    }

                    .active .fab-navigate {
                        bottom: 160px;
                    }

                    .active .fab-search {
                        bottom: 90px;
                    }

                    .active .fab-menu {
                        background-color: #00E4E4;
                    }

                    .fab {
                        border-radius: 50%;
                        padding: 20px;
                        position: fixed;
                        bottom: 20px;
                        left: 20px;

                        box-shadow: 0 10px 20px rgba(0,0,0,.19),0 6px 6px rgba(0,0,0,.23);

                        color: white;
                        background-color: #009898;
                        cursor: pointer;

                        -webkit-transition: all 200ms ease-out 0s;
                        -moz-transition: all 200ms ease-out 0s;
                        -ms-transition: all 200ms ease-out 0s;
                        -o-transition: all 200ms ease-out 0s;
                        transition: all 200ms ease-out 0s;
                    }

                    .fab:hover {
                        box-shadow: 0 19px 38px rgba(0,0,0,.3),0 15px 12px rgba(0,0,0,.22);
                    }

                    .swipe-header {
                        position: relative;
                        margin-top: -15px;
                        margin-bottom: 15px;
                        top: 0;
                        right: 0;
                        float: none;
                        background: #9A9CFE;
                        text-align: center;
                        padding: 5px;
                        padding-left: 10px;
                        border-radius: 5px;
                    }
                </style>

                <div class="frame" id="rooster-block" style="overflow: hidden;">
                    <ul class="clearfix">
                        <?php

                        $this->model('ScheduleDrawer');
                        $weekdays = [ 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag' ];

                        foreach ($_data['day_data'] as $date => $data) {
                            ?>

                            <li>
                                <div class="sh-header">
                                    <span><?php echo $weekdays[date("w", strtotime($date)) - 1]; ?></span>
                                    <small>(<?php echo date("j-n-'y", strtotime($date)); ?>)</small>
                                </div>
                                <div class="sh-container">

                                    <?php
                                    if(!empty($data)) {
                                        foreach ($data as $hour) {
                                            $time_start = substr($hour['Starttime'], 0, 5);
                                            $time_end = substr($hour['Endtime'], 0, 5);

                                            $block_height = ScheduleDrawer::get_block_height($time_start, $time_end);
                                            $block_top = ScheduleDrawer::get_top_offset($time_start);
                                            ?>

                                            <div class="sh sh-default" title="<?php echo $hour['id_Hour']; ?>"
                                                 style="<?php echo "height: $block_height; top: $block_top"; ?>">
                                                <h3><?php echo $hour['Subjecttext']; ?></h3>
                                                <h4><?php echo $time_start; ?>
                                                    <small>t/m</small> <?php echo $time_end; ?></h4>
                                                <h4><?php echo $hour['Initials'] . " - " . $hour['Classroomname']; ?></h4>
                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </li>

                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fab-collective visible-xs">
    <div class="fab fab-navigate"><i class="fa fa-calendar fa-lg"></i></div>
    <div class="fab fab-search"><i class="fa fa-search fa-lg"></i></div>
    <div class="fab fab-menu" onclick="$(this).parent().toggleClass('active');"><i class="fa fa-bars fa-lg"></i></div>
</div>
