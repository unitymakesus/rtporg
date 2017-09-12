<?php
    /*
     * This functionality is being used in multiple templates, so I've moved it to a partial.
     *
     * TODO: Need to track down all instances where this messaging/html is duplicated
     * within the templates, and port them over to use this partial.
     *
     * Code to use: get_template_part( 'partials/posts', 'none' );
     * make sure to place the function inside php tags.
     */
?>
<div class="post error404 not-found source-local">
    <div class="entry-content">
        <div class="alert-box info">Actually, we couldn't find anything. Try searching again.</div>
    </div>
</div>