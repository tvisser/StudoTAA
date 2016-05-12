<!-- Sly -->
<script src="/plugins/sly/sly.min.js"></script>
<script>

    var width = $(window).width();
    var timeout = false;

    function init_sly() {
        timeout = false;

        var $frame = jQuery('#oneperframe');
        var $clearfix = jQuery('ul.clearfix li');

        $clearfix.css( "width", $frame.width() );

        // Call Sly on frame
        $frame.sly(false);
        $frame.sly({
            horizontal: 1,
            itemNav: 'forceCentered',
            smart: 1,
            activateMiddle: 1,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            startAt: 0,
            scrollBy: 1,
            speed: 100,
            elasticBounds: 1,
            dragHandle: 1,
            dynamicHandle: 1
        });
    }

    $(window).resize( function() {
        if(width != $(window).width() && timeout == false) {
            width = $(window).width();
            console.log(width);
            setTimeout(init_sly, 300);
            timeout = true;
        }
    } );

    $(document).ready( init_sly );
</script>