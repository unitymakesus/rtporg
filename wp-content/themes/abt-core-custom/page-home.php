<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header('new');

$hp_career_link = types_render_field("hp-career-link", array("raw"=>"true"));
$hp_company_directory_link = types_render_field("hp-company-directory-link", array("raw"=>"true"));
$hp_lease_office_space_link = types_render_field("hp-lease-office-space-link", array("raw"=>"true"));
$hp_buy_land_link = types_render_field("hp-buy-land-link", array("raw"=>"true"));

?>
    <div class="content-container">
        <section id="hero-video" class="band hero-video">
            <video autoplay loop muted class="bg-video">
                <source src="//files.rtp.org/videos/RTPExportforWeb.webm" type="video/webm">
                <source src="//files.rtp.org/videos/RTPExportforWeb.mp4" type="video/mp4">
                <source src="//files.rtp.org/videos/RTPExportforWeb.ogv" type="video/ogg">
            </video>
            <div class="wrapper band-stretch-first hero-video-meta">
                <div class="load-fade-in-left" data-aos="fade-right">
                    <header>
                        <h1>Research Triangle Park</h1>
                        <p>Where Bold Ideas <br/>Flourish</p>
                    </header>
                    <p>We break new ground every day by innovating together.<br /> Join us in making the future.</p>
                </div>
                <div class="band-center">
                    <a href="https://www.youtube.com/watch?v=LZuvQFRbZJI" class="hero-video-button popup-youtube" data-aos="zoom-out">
                        <span class="visuallyhidden">Play</span> <div class="pulse-ring"></div>
                    </a>
                </div>
            </div>

            <div class="scroll-indicator-wrapper scroll-to-section" data-target="innovation-band" data-animation-length="300">
                <div class="scroll-indicator-new">
                    <span>Discover</span>
                    <span class="css-arrow"></span>
                </div>
            </div>

            <div class="blue-triangle"></div>

        </section>

        <section id="innovation-band" class="band">
            <div class="wrapper">
                <header class="band-header fade-in-up-staggered" data-aos="fade-up">
                    <h2>Innovation Starts Here</h2>
                    <p>What sets us apart? Every member of our community.</p>
                </header>
                <div id="stat-cards" class="band-half">
                    <div class="card-stat fade-in-up-staggered" data-aos="fade-right">
                        <div class="card-stat-count text-gradient-blue">250+</div>
                        <div class="card-stat-meta">Businesses of All Sizes Call RTP Home</div>
                    </div>
                    <div class="card-stat fade-in-up-staggered" data-aos="zoom-out">
                        <div class="card-stat-count text-gradient-blue">50k+</div>
                        <div class="card-stat-meta">Intelligent & Creative People Work Here</div>
                    </div>
                    <div class="card-stat fade-in-up-staggered" data-aos="zoom-out">
                        <div class="card-stat-count text-gradient-blue">3k+</div>
                        <div class="card-stat-meta">Patents Awarded to RTP Businesses</div>
                    </div>
                    <div class="card-stat fade-in-up-staggered" data-aos="fade-left">
                        <div class="card-stat-count text-gradient-blue">#1</div>
                        <div class="card-stat-meta">Largest Research Park in the Country</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="young-talent" class="band theme-gray">
            <div class="wrapper band-half band-reverse-desktop" style="overflow: hidden;">
                <header class="band-header band-header-inline band-header-left fade-in-right-staggered" data-aos="zoom-in">
                    <h2>A Triangle of Talent</h2>
                    <p>The Triangle is one of the smartest areas in the country. Over 50% of the population has a bachelor’s degree, and more than 8,500 young minds graduate annually from the region’s top research universities.</p>
                </header>
                <div class="block-grid fade-in-right-staggered" data-aos="fade-right">
                    <div class="block block-logo theme-white">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-duke.png" alt="Duke University">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-duke.png" alt="Duke University" />
                      </noscript>
                    </div>
                    <div class="block block-logo theme-white fade-in-right-staggered" data-aos="fade-right">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-ncsu.png" alt="North Carolina State University">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-ncsu.png" alt="North Carolina State University" />
                      </noscript>
                    </div>
                    <div class="block block-logo theme-white fade-in-right-staggered" data-aos="fade-right">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-unc.png" alt="University of North Carolina at Chapel Hill">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-unc.png" alt="University of North Carolina at Chapel Hill" />
                      </noscript>
                    </div>
                    <div class="block block-more block-more-orange fade-in-right-staggered" data-aos="fade-right">
                        <a href="<?= $hp_career_link; ?>" target="blank">
                            <div class="block-more-wrapper">
                                <strong><span>Kickstart</span></strong>
                                <span>Your Career</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="band theme-gray-mobile" style="overflow: hidden;">
            <div class="wrapper">
                <header class="band-header pad-none fade-in-up" data-aos="fade-up">
                    <h2>A Long Tradition of Invention</h2>
                    <p>RTP minds have created everything from the UPC barcode to life-saving HIV drugs. Show us what’s next.</p>
                </header>
                <div>
                    <div id="infographic-brain" class="infographic-brain">
                        <div class="panel-left">
                          <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/infographic-brain-left.svg" class="slide-in-down infographic-brain__left" alt="Left brain illustration = analytic">
                            <img class="slide-in-down infographic-brain__left" data-aos="fade-down" src="<?php echo get_stylesheet_directory_uri();?>/img/infographic-brain-left.svg" alt="Left brain illustration = analytic">
                          </noscript>
                          <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/infographic-helix.svg" class="infographic-brain-absolute slide-in-left" alt="Molecules">
                            <img class="infographic-brain-absolute slide-in-left" data-aos="fade-left" onkeypress="" src="<?php echo get_stylesheet_directory_uri();?>/img/infographic-helix.svg" alt="Molecules">
                          </noscript>
                        </div>
                        <div class="panel-right">
                          <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/infographic-brain-right.svg" class="slide-in-up infographic-brain__right" alt="Right brain illustration = creative">
                            <img class="slide-in-up infographic-brain__right" data-aos="fade-up" src="<?php echo get_stylesheet_directory_uri();?>/img/infographic-brain-right.svg" alt="Right brain illustration = creative">
                          </noscript>
                          <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/infographic-barcode.svg" class="infographic-brain-absolute infographic-barcode slide-in-right" alt="Barcode">
                            <img class="infographic-brain-absolute infographic-barcode slide-in-right" data-aos="fade-right" src="<?php echo get_stylesheet_directory_uri();?>/img/infographic-barcode.svg" alt="Barcode">
                          </noscript>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="company-logos" class="band pad-large-bottom theme-gray">
            <div class="wrapper">
                <header  class="band-header pad-more fade-in-up-staggered" data-aos="fade-up">
                    <h2>A Culture of Diverse Expertise</h2>
                    <p>From legendary corporations to disruptive startups, we welcome visionary businesses of all sizes to our innovative community.</p>
                </header>
                <div class="logo-set-alternate block-quarter group">
                    <div class="block block-logo fade-in-up-staggered" data-aos="fade-left">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-cisco.png" alt="Cisco">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-cisco.png" alt="Cisco">
                      </noscript>
                    </div>
                    <div class="block block-logo fade-in-up-staggered" data-aos="fade-left">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-fidelity.png" alt="Fidelity">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-fidelity.png" alt="Fidelity">
                      </noscript>
                    </div>
                    <div class="block block-logo fade-in-up-staggered" data-aos="fade-left">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-gsk.png" alt="GSK">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-gsk.png" alt="GSK">
                      </noscript>
                    </div>
                    <div class="block block-logo fade-in-up-staggered" data-aos="fade-left">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-ibm.png" alt="IBM">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-ibm.png" alt="IBM">
                      </noscript>
                    </div>
                    <div class="block block-logo fade-in-up-staggered" data-aos="fade-right">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-lenovo.png" alt="Lenovo">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-lenovo.png" alt="Lenovo">
                      </noscript>
                    </div>
                    <div class="block block-logo fade-in-up-staggered" data-aos="fade-right">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-netapp.png" alt="NetApp">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-netapp.png" alt="NetApp">
                      </noscript>
                    </div>
                    <div class="block block-logo fade-in-up-staggered" data-aos="fade-right">
                      <noscript data-src="<?php echo get_stylesheet_directory_uri();?>/img/logo-rti.png" alt="RTI">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo-rti.png" alt="RTI">
                      </noscript>
                    </div>
                    <div class="block block-more block-more-blue fade-in-up-staggered" data-aos="fade-right">
                        <a href="<?= $hp_company_directory_link; ?>">
                            <div class="block-more-wrapper">
                                <strong><span>View All</span></strong>
                                <span>Our Companies</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section id="quote-band" class="band band-bg-right theme-dark pad-none-desktop" style="background-image: url(<?php echo get_stylesheet_directory_uri();?>/img/bg_architecture-lines.png);">
            <div class="wrapper">
                <header class="visuallyhidden"><h2>Quote</h2></header>
                <div id="quote-band" class="quote-band band-stretch-first">
                    <blockquote>
                        <p class="fade-in-up-staggered">Thanks to the invaluable resources here at the park, my business has exponentially grown. the culture is addictive and always thriving.</p>
                        <span class="cite fade-in-up-staggered"><strong>Micheal Smith</strong> CEO, Company XYZ</span>
                    </blockquote>
                    <img src="<?php echo get_stylesheet_directory_uri();?>/img/testimonial-img.png" alt="Quote image">
                </div>
            </div>
        </section> -->

        <section id="make-your-mark" class="band">
            <div class="wrapper">
                <header class="band-header pad-less fade-in-up-staggered" data-aos="fade-up">
                    <h2>Make Your Mark on the RTP</h2>
                    <p>Explore the possibilities for the new home of your business.</p>
                </header>
                <div class="cta-cards">
                    <a href="<?= $hp_lease_office_space_link; ?>" target="blank" class="card-cta card-cta-laptop fade-in-up-staggered" data-aos="fade-right">
                        <span class="card-cta-meta">
                            <strong>Lease Office Space.</strong>
                            Choose an existing configuration today.
                        </span>
                    </a>
                    <a href="<?= $hp_buy_land_link; ?>" class="card-cta card-cta-lines fade-in-up-staggered" data-aos="fade-left">
                        <span class="card-cta-meta">
                            <strong>Buy Land.</strong>
                            View available sites and make one your own.
                        </span>
                    </a>
                </div>
            </div>
        </section>

        <?php
            //get the next upcoming food truck event
            $foodTruckEvent = get_next_food_truck_event();
            $sigEvents = get_events_by_category('signature-events', 3);
        ?>
        <section id="upcoming-events" class="band theme-gray">
            <div class="wrapper">
                <header id="header-upcoming-events" class="band-header pad-less">
                    <h2><?php echo __('Upcoming Events'); ?></h2>
                    <p><?php echo __('Connect with us and get to know your community.'); ?></p>
                </header>
                <ul class="block-events" style="overflow: hidden;">
                    <?php if ($foodTruckEvent) : ?>
                        <li class="block-event block-event-featured fade-in-right-staggered" data-aos="fade-right" style="background-image: url(<?php echo get_stylesheet_directory_uri();?>/img/bg_event-featured.jpg);">
                            <a href="<?php echo esc_url(get_post_permalink($foodTruckEvent->ID)); ?>" class="block-event-wrapper">
                                <div class="block-event-date">
                                    <span class="block-event-day"><?php echo date('j', get_post_meta($foodTruckEvent->ID, 'wpcf-event-end-date-and-time', true)) ?></span>
                                    <span class="block-event-month" data-month="January"><?php echo date('M', get_post_meta($foodTruckEvent->ID, 'wpcf-event-end-date-and-time', true)) ?></span>
                                    <span class="block-event-weekday" data-weekday="Wednesday"><?php echo date('D', get_post_meta($foodTruckEvent->ID, 'wpcf-event-end-date-and-time', true)) ?></span>
                                </div>
                                <div class="block-event-title"><?php echo $foodTruckEvent->post_title ? $foodTruckEvent->post_title : 'Food Truck Rodeo' ?></div>
                                <div class="block-event-description"><?php echo __('Bring your friends, bring your colleagues, and come out to The Frontier for good eats.'); ?></div>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php foreach ($sigEvents as $sigEvent) : ?>
                        <li class="block-event fade-in-right-staggered" data-aos="fade-down">
                            <a href="<?php echo esc_url(get_post_permalink($sigEvent->ID)); ?>" class="block-event-wrapper">
                                <div class="block-event-date text-gradient-orange">
                                    <span class="block-event-day" data-day="<?php echo date('j', get_post_meta($sigEvent->ID, 'wpcf-event-start-date-and-time', true)) ?>"><?php echo date('j', get_post_meta($sigEvent->ID, 'wpcf-event-start-date-and-time', true)) ?></span>
                                    <span class="block-event-month" data-month="<?php echo date('F', get_post_meta($sigEvent->ID, 'wpcf-event-start-date-and-time', true)) ?>"><?php echo date('M', get_post_meta($sigEvent->ID, 'wpcf-event-end-date-and-time', true)) ?></span>
                                    <span class="block-event-weekday" data-weekday="<?php echo date('l', get_post_meta($sigEvent->ID, 'wpcf-event-start-date-and-time', true)) ?>"><?php echo date('D', get_post_meta($sigEvent->ID, 'wpcf-event-end-date-and-time', true)) ?></span>
                                </div>
                                <div class="block-event-title"><?php echo mb_strimwidth($sigEvent->post_title ? $sigEvent->post_title : __('Signature Event'), 0, 45, '...'); ?></div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <li class="block-more block-more-orange fade-in-right-staggered" data-aos="fade-right">
                        <a href="events/">
                            <div class="block-more-wrapper">
                                <strong><span><?php echo __('View Full'); ?></span></strong>
                                <span><?php echo __('Event Calendar'); ?></span>
                            </div>
                        </a>
                    </li>
                </ul>

            </div>
        </section>

        <section id="social-outreach" class="band theme-gray pad-bottom">
            <div class="wrapper">
                <header class="band-header pad-less fade-in-up-staggered" data-aos="fade-up">
                    <h2>Social Outreach</h2>
                    <p>Engage with us as we move RTP forward.</p>
                </header>
                <div id="block-socials" class="block-socials">

                    <?php
                    //collecting latest tweets and instagram posts
                    $tweets = getLatestTweetsForRTP(4);
                    $tweetObjects = json_decode(json_encode($tweets), FALSE);
                    $instaPosts = getLatestInstagramForRTP(4);

                    if (!empty($tweetObjects)) {
                      foreach ($tweetObjects as $tweet) {
                          $tweetText[] = $tweet->full_text;
                          $tweetId[] = $tweet->id_str;
                          $tweetScreenName[] = $tweet->user->screen_name;

                          // echo '<pre>';
                          // echo print_r($tweet);
                          // echo '</pre>';
                      }
                    }

                    if (!empty($instaPosts)) {
                      foreach ($instaPosts as $instaPost) {
                          $instaPostLink[] = $instaPost->link;
                          $instaPostImg[] = $instaPost->images->standard_resolution->url;
                      }
                    }


                    // recent posts
                    $blogPostArgs = array( 'numberposts' => '4', 'order' => 'DESC','post_status' => 'publish' );
                    $recentBlogPosts = wp_get_recent_posts( $blogPostArgs );
                    if (!empty($recentBlogPosts)) {
                      foreach( $recentBlogPosts as $recent ) {

                          $postPermalinks[] = get_permalink( $recent["ID"] );
                          $postTitles[] = $recent["post_title"];
                          $postDates[] = date("M d", strtotime($recent['post_date']));

                          $cats = get_the_category($recent["ID"]);
                          $postCatNames[] = $cats[0]->name;
                      }
                    }
                    ?>

                    <div class="block-socials__col">
                        <!-- Instagram Post 1 -->
                        <?php echo '<a href="' . $instaPostLink[0] . '" target="blank" class="block-social__instagram-item fade-in-up-staggered" data-aos="fade-up">
                            <span class="icon icon-i_instagram"></span>
                            <noscript data-src="' . $instaPostImg[0] . '" alt="">
                            <img src="' . $instaPostImg[0] . '" alt="" />
                            </noscript>
                        </a>'; ?>

                        <!-- Instagram Post 2 -->
                        <?php echo '<a href="' . $instaPostLink[1] . '" target="blank" class="block-social__instagram-item fade-in-up-staggered"data-aos="fade-up">
                            <span class="icon icon-i_instagram"></span>
                            <noscript data-src="' . $instaPostImg[1] . '" alt="">
                            <img src="' . $instaPostImg[1] . '" alt="" />
                            </noscript>
                        </a>'; ?>
                        <!-- Blog Post 2 -->
                        <a href="<?php echo $postPermalinks[1]; ?>" class="block-social__blog-item fade-in-up-staggered" data-aos="fade-up">
                            <div class="block-social__blog-category"><?php echo $postCatNames[1]; ?></div>
                            <div class="block-social__blog-title"><?php echo $postTitles[1]; ?></div>
                            <div class="block-social__blog-meta">
                                <strong>Blog</strong> / <span class="block-social__blog-date"><?php echo $postDates[1]; ?></span>
                            </div>
                        </a>
                    </div>

                    <div class="block-socials__col">
                        <!-- Blog Post 1 -->
                        <a href="<?php echo $postPermalinks[0]; ?>" class="block-social__blog-item fade-in-up-staggered" data-aos="fade-down">
                            <div class="block-social__blog-category"><?php echo $postCatNames[0]; ?></div>
                            <div class="block-social__blog-title"><?php echo $postTitles[0]; ?></div>
                            <div class="block-social__blog-meta">
                                <strong>Blog</strong> / <span class="block-social__blog-date"><?php echo $postDates[0]; ?></span>
                            </div>
                        </a>
                        <!-- Instagram Post 3 -->
                        <?php echo '<a href="' . $instaPostLink[2] . '" target="blank" class="block-social__instagram-item fade-in-up-staggered" data-aos="fade-right">
                            <span class="icon icon-i_instagram"></span>
                            <noscript data-src="' . $instaPostImg[2] . '" alt="">
                            <img src="' . $instaPostImg[2] . ' alt="" />
                            </noscript>
                        </a>'; ?>
                        <!-- Tweet 1 -->
                        <a href="https://twitter.com/TheRTP/statuses/<?php echo $tweetId[0]; ?>" target="blank" class="block-social__twitter-item fade-in-up-staggered" data-aos="fade-up">
                            <span class="icon icon-i_twitter"></span>
                            <div class="block-social__twitter-text">
                                <?php echo mb_strimwidth($tweetText[0], 0, 120, '...'); ?>
                            </div>
                        </a>
                    </div>




                    <div class="block-socials__col">
                        <!-- Instagram 4 -->
                        <?php echo '<a href="' . $instaPostLink[3] . '" target="blank" class="block-social__instagram-item fade-in-up-staggered" data-aos="fade-up">
                            <span class="icon icon-i_instagram"></span>
                            <noscript data-src="' . $instaPostImg[3] . '" alt="">
                            <img src="' . $instaPostImg[3] . '" alt="" />
                            </noscript>
                        </a>'; ?>
                        <!-- Tweet 3 -->
                        <a href="https://twitter.com/TheRTP/statuses/<?php echo $tweetId[2]; ?>" target="blank" class="block-social__twitter-item fade-in-up-staggered" data-aos="fade-up">
                            <span class="icon icon-i_twitter"></span>
                            <div class="block-social__twitter-text">
                                <?php echo mb_strimwidth($tweetText[2], 0, 120, '...'); ?>
                            </div>
                        </a>
                        <!-- Post 4 -->
                        <a href="<?php echo $postPermalinks[3]; ?>" class="block-social__blog-item fade-in-up-staggered" data-aos="fade-up">
                            <div class="block-social__blog-category"><?php echo $postCatNames[3]; ?></div>
                            <div class="block-social__blog-title"><?php echo $postTitles[3]; ?></div>
                            <div class="block-social__blog-meta">
                                <strong>Blog</strong> / <span class="block-social__blog-date"><?php echo $postDates[3]; ?></span>
                            </div>
                        </a>
                    </div>

                    <div class="block-socials__col">
                        <!-- Tweet 2 -->
                        <a href="https://twitter.com/TheRTP/statuses/<?php echo $tweetId[1]; ?>" target="blank" class="block-social__twitter-item fade-in-up-staggered" data-aos="fade-up">
                            <span class="icon icon-i_twitter"></span>
                            <div class="block-social__twitter-text">
                                <?php echo mb_strimwidth($tweetText[1], 0, 120, '...'); ?>
                            </div>
                        </a>
                        <!-- Post 3 -->
                        <a href="<?php echo $postPermalinks[2]; ?>" class="block-social__blog-item fade-in-up-staggered" data-aos="fade-up">
                            <div class="block-social__blog-category"><?php echo $postCatNames[2]; ?></div>
                            <div class="block-social__blog-title"><?php echo $postTitles[2]; ?></div>
                            <div class="block-social__blog-meta">
                                <strong>Blog</strong> / <span class="block-social__blog-date"><?php echo $postDates[2]; ?></span>
                            </div>
                        </a>
                        <!-- Tweet 4 -->
                        <a href="https://twitter.com/TheRTP/statuses/<?php echo $tweetId[3]; ?>" target="blank" class="block-social__twitter-item fade-in-up-staggered" data-aos="fade-up">
                            <span class="icon icon-i_twitter"></span>
                            <div class="block-social__twitter-text">
                                <?php echo mb_strimwidth($tweetText[3], 0, 120, '...'); ?>
                            </div>
                        </a>
                    </div>



                </div>
            </div>
        </section>

    </div>


<!-- end example code -->
<?php get_footer('new'); ?>
