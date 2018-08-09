<?php
    /*
     * Use this to display event posts. I've migrated this from the default loop template,
     *
     * The main loop template (loop.php) is not architected in such a way
     * that you can reliably determine whether any posts are actually being displayed to the user.
     * This means that sometimes no results are displayed, and you're left with a blank content section
     * because using have_posts only works if you do all filtering via wp_query parameters.
     *
     * For instance, event posts are being "filtered" via PHP using conditional statements
     * rather than using wp_query arguments, so it's possible that wp_query
     * has returned 1 or more posts and thus the above have_posts() function
     * will return true, and the no results message doesn't get displayed.
     *
     * Rather than attempt to refactor the entire loop template,
     * write something horribly unmaintainable, or try to untangle the mess of wp-queries,
     * I have opted to port events to a separate loop template.
     *
     * This issue was exposed after addressing another issue where the drop-down filter
     * (i.e. Discover) did not work for events. After correcting that issue, it became clear
     * that in many cases, there weren't any non-expired events for a given term,
     * a situation that resulted in a blank content section with no messaging to
     * indicate to the user that no results were found.
     *
     *
     * The better long term strategy would be to update wp_query for events so that
     * the date filtering (event date >= current date) is done via wp_query, then
     * none of this would be an issue AND pagination would work correctly.
     *
     * However, for the sake of time, this current implementation should suffice until
     * we have more resources to refactor.
     *
     * TODO: Refactor templates/code so that we're using WP_Query to filter events
     * TODO: Refactor template to reflect PHP coding standards
     * TODO: Refactor template to make plain-text translatable
     *
     *
     *
     * 3/12/2015 : Calendar Integration
     *
     * We are integrating a javascript calendar with the events. For the time being, I'll include it
     * here in the events loop.
     *
     * - By including it here, we can use the same loop as the standard social tile display, so
     *   it gives us a better guarantee that the tiles and the calendar will display the exact
     *   same data.
     *
     * - We've developed a wrapper object for the calendar library in /js/events.calendar.custom.js.
     *   WordPress does not supply a straight-forward way yo conditionally enqueue
     *   a javascript file in a template loop (there are ways, they're awful), so we're breaking
     *   the rules a bit and simply using <script src=""> to include our wrapper.
     *
     *
     *
     *
     */

    global $post;
    $theme_dir = get_stylesheet_directory_uri();

    // Found this magic number while reviewing code
    // Rather than have it hidden and nested, and in lieu of the fact
    // that tracking down the reasoning for using a magic number is going to take
    // a bit of time, I'm at least moving this to the top of the template
    // so that we can hopefully correct this at a later date and time
    // TODO: Re-implement this so that we're not using magic numbers in our templates
    $user_avatar_magic_number = 48;


    /*
     * Here's what's happening....
     *
     * We can't rely on have_posts (due to filtering outside of wp_query), so
     * we'll buffer the output of the social grid section.
     *
     * If we determine that at least one post has been displayed, output the buffer to the screen.
     * Otherwise, show the no results message.
     *
     */
    global $wp_query;
    $args = array_merge( $wp_query->query , array( 'posts_per_page' => -1 ) );
    // For now, I'm going to show all posts, this will mitigate issues with pagination and the fact that
    // pagination won't work when we filter results after getting them back from wp_query
    query_posts( $args );
?>
<?php
    // I'm using this as a flag so I know whether we've displayed a post to the user
    $post_visible = false;
    // Use this to track calendar data
    $calendar_data = array();
    ob_start();
?>
<?php // Calendar / Grid view toggle ?>
<div id="events-toolbar" class="events-toolbar">
    <div class="events-display-toggle">
        <button class="active"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_events.svg" /> <span><?php _e( 'Calendar', 'abt-core' ); ?></span></button>
        <button><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_grid.svg" /> <span><?php _e( 'Grid', 'abt-core' ); ?></span></button>
    </div>
</div>

<section class="source-local social-grid">
    <?php while ( have_posts() ) : the_post(); ?>
            <?php
                $user_id      = get_the_author_meta( 'ID' );
                $user_obj     = get_userdata( $user_id );
                $user_role     = ($user_obj->roles[0] == "contributor") ? "rtp-contributor" : $user_obj->roles[0];
                $display_role  = ($user_role == "administrator") ? "Author" : ucwords(str_replace("-", " ", $user_role));
                $thumb        = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $thumb_url    = ( $thumb['0'] != null ) ? 'style="background-image: url(' . $thumb["0"] . ');"' : '';
                $lp_thumb     = types_render_field( "landing_page_image", array( "raw" => "true" ) );
                $location     = types_render_field( "event-location", array( "raw" => "true" ) );
                $sponsor      = types_render_field( "event-organization-sponsor", array( "raw" => "true" ) );
                $today        = date( 'Y-m-d' );
                $start_time   = types_render_field( "event-start-date-and-time", array( "format" => "M j g:i a" ) );
                $date_time    = types_render_field( "event-start-date-and-time", array( "format" => "Y-m-d" ) );
                $event_terms = get_the_terms( $post->ID, 'event-categories' );
                $location_classes = '';

                if ( $event_terms && ! is_wp_error( $event_terms ) ) :
                    $event_classes = array();
                    foreach ( $event_terms as $term ) {
                        $event_classes[] = $term->slug;
                    }
                    $location_classes = join( " ", $event_classes );
                endif;

                if ($date_time >= $today) :
                    $location_classes .= ' upcoming';
                endif;

            ?>
            <?php // Construct calendar data. Assumes entries are already ordered by time (early to late) ?>
                <?php $calendar_date = types_render_field( 'event-start-date-and-time', array( 'format' => 'm-d-Y') ); ?>
                <?php $calendar_data[$calendar_date] .= '<a class="'. $location_classes .'" href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>'; ?>

            <?php if ($date_time >= $today) : ?>
                <?php // Set flag to confirm there are results ?>
                <?php $post_visible = true; ?>


                <?php // Start regular rendering of template / content ?>
                <?php if($lp_thumb) : ?>
                    <article class=" source-local social-tile type-hybrid standard hentry post" style="background-image: url('<?php echo $lp_thumb; ?>');" itemscope itemtype="http://data-vocabulary.org/Event">
                <?php else : ?>
                    <article class=" source-local social-tile type-hybrid standard hentry post" <?php echo $thumb_url; ?> itemscope itemtype="http://data-vocabulary.org/Event">
                <?php endif; ?>
                    <h1 class="entry-title" itemprop="summary"><?php the_title(); ?></h1>
                    <time class="start-date" itemprop="startDate" datetime="<?php echo $date_time; ?>"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_events.svg" /> <?php echo $start_time; ?></time>
                    <div class="location" itemprop="location">
                        <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_location.svg" /> <?php echo $location; ?>
                    </div>
                    <div class="options">
                        <button class="open-options"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_options-right.svg" /></button>
                        <ul>
                            <li data-option="favorite">
                                <span class="label" title="Favorite">
                                    <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_info.svg" />
                                    <span class="visuallyhidden">Info</span>
                                </span>
                                <div class="panel">
                                    <h3>Summary</h3>
                                    <p><strong>Date</strong><br><?php echo $start_time; ?></p>
                                    <p><strong>Location</strong><br><?php echo $location; ?></p>
                                    <p><strong>Sponsor</strong><br><?php echo $sponsor; ?></p>
                                </div>
                            </li>
                            <li data-option="source">
                                <span class="label" title="Source">
                                    <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_source.svg" />
                                    <span class="visuallyhidden">Source</span>
                                </span>
                                <div class="panel">
                                    <h3>Source</h3>
                                    <a class="button secondary" href="<?php the_permalink(); ?>"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_source.svg" /> View Article</a>
                                </div>
                            </li>
                            <li data-option="author">
                                <span class="label" title="Author">
                                    <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_about-us.svg" />
                                    <span class="visuallyhidden">Author</span>
                                </span>
                                <div class="panel">
                                    <h3>Author</h3>
                                    <div class="author">
                                      <?php echo get_avatar( $user_id, apply_filters( 'abtcore_author_bio_avatar_size', 60 ) ); ?>

                                        <?php /*if ( has_wp_user_avatar($user_id) ) {
                                            echo get_wp_user_avatar($user_id, $user_avatar_magic_number);
                                        } else {
                                            echo '<img class="svg" src="' . $theme_dir . '/img/icons/i_about-us.svg" />';
                                        }*/ ?>
                                        <strong><?php the_author_posts_link(); ?></strong><br />
                                        <span class="badge <?php echo $user_role; ?>"><?php echo $display_role; ?></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark">View Event</a>
                </article>
            <?php endif; ?>
    <?php endwhile; ?>
</section>

<?php // Save buffer in case we need it ?>
<?php $section = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php // if there are posts to show, then output the buffer, otherwise show no results message ?>
<?php if ( empty( $post_visible )  || ! have_posts() ): ?>
    <?php get_template_part( 'partials/posts', 'none' ); ?>
<?php else: ?>
    <?php // Render page content (from above) ?>
    <?php echo $section; ?>
    <?php // Render Calendar ?>
    <section id="events-calendar" class="custom-calendar-wrap custom-calendar-full">
        <div class="custom-header clearfix">
            <h3 class="custom-month-year">
                <span id="custom-month" class="custom-month"></span>
                <span id="custom-year" class="custom-year"></span>

            </h3>
            <div class="events-legend">
                <ul>
                    <li class="event-past">Past event</li>
                    <li class="event-triangle">The Triangle</li>
                    <li class="event-rtphq">RTP HQ</li>
                    <li class="event-frontier">The Frontier</li>
                </ul>
            </div>
            <nav>
                <span id="custom-prev" class="custom-prev">
                    <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_left-arrow.svg" />
                </span>
                <span id="custom-current" class="custom-current" title="Got to current date">
                    Today
                </span>
                <span id="custom-next" class="custom-next">
                    <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_right-arrow.svg" />
                </span>
            </nav>
        </div>
        <div id="calendar" class="fc-calendar-container"></div>
    </section>
    <?php   // This is not the right way to include a script, but it's the only way
            // to conditionally include this script on a loop template
            // in WordPress without jumping through a lot of hoops and
            // introducing a lot of complexity and possible instability
    ?>
    <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/events.calendar.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-events.min.js"></script>
    <script type="text/javascript">
        $(function() {
            // Fire up calendar
            AbtEventsCalendar.init(
                <?php echo json_encode($calendar_data); ?>,
                {
                    'calendarElem' : $('#calendar'),
                    'monthElem'    : $('#custom-month'),
                    'yearElem'     : $('#custom-year'),
                    'ctrlNextElem' : $('#custom-next'),
                    'ctrlPrevElem' : $('#custom-prev'),
                    'ctrlCurrElem' : $('#custom-current')
                }
            );
        });
    </script>
<?php endif; ?>

<?php // ABT says: Pagination isn't going to work (due to filtering outside of wp_query, but I'll leave this in for shits and giggles ?>
<?php // Unity says: Huh? Okay, then we'll comment it out. ?>
<?php /*if (function_exists("pagination")): ?>
    <?php pagination($additional_loop->max_num_pages); ?>
<?php endif;*/ ?>
