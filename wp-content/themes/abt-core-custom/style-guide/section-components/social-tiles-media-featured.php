<?php
    $theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-social-tiles">
    <h2 class="title">Social Tile - Media, Featured</h2>
    <p class="description">Display the featured size media-only tile.</p>
    <div class="preview">
        <section class="social-grid">
            <article class="social-tile type-media featured hentry" style="width: 600px; padding-bottom: 300px; background-image: url(http://distilleryimage4.ak.instagram.com/2e04e83acbfe11e3b6a30002c954b60c_8.jpg);">
            <time class="published" datetime="2014-11-12">
                <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_clock.svg" /> Nov 12 2014
            </time>
            <div class="options">
                <button class="open-options"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_options-right.svg" /></button>
                <ul>
                    <li data-option="favorite">
                        <span class="label" title="Favorite">
                            <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_favorite-active.svg" />
                            <span class="visuallyhidden">Favorite</span>
                        </span>
                        <div class="panel">
                            <h3>Likes</h3>
                            <div class="likes">168</div>
                            <button class="primary"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_favorite-active.svg" /> You Liked</button>
                        </div>
                    </li>
                    <li data-option="share">
                        <span class="label" title="Share">
                            <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_share.svg" />
                            <span class="visuallyhidden">Share</span>
                        </span>
                        <div class="panel">
                            <h3>Share</h3>
                            <ul class="share">
                                <li class="facebook">
                                    <a href="#"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" /></a>
                                </li>
                                <li class="twitter">
                                    <a href="#"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" /></a>
                                </li>
                                <li class="google">
                                    <a href="#"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" /></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li data-option="source">
                        <span class="label" title="Source">
                            <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_source.svg" />
                            <span class="visuallyhidden">Source</span>
                        </span>
                        <div class="panel">
                            <h3>Source</h3>
                            <a class="button secondary" href="#"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_source.svg" /> View Source</a>
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
                                <img src="https://lh3.googleusercontent.com/-aD01iSxuGZ8/AAAAAAAAAAI/AAAAAAAAAAA/jJv6M3FTHt8/s46-c-k-no/photo.jpg" />
                                <strong>John Smith</strong>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <a class="expand" href="#">
                <img class="svg action-expand" src="<?php echo $theme_dir; ?>/img/icons/i_expand-alt.svg" /> <span class="visuallyhidden">Expand</span>
                <img class="svg action-collapse" src="<?php echo $theme_dir; ?>/img/icons/i_menu-close.svg" /> <span class="visuallyhidden">Collapse</span>
            </a>
        </article>
        </section>
    </div>
    <pre><code class="language-markup">
&lt;article id=&quot;...&quot; class=&quot;social-tile type-media featured hentry&quot;&gt;
    &lt;div class=&quot;u-photo&quot;&gt;
        &lt;img src=&quot;...&quot; /&gt;
    &lt;/div&gt;
    &lt;time class=&quot;published&quot; datetime=&quot;...&quot;&gt;
        &lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt; ...
    &lt;/time&gt;
    &lt;div class=&quot;options&quot;&gt;
        &lt;button class=&quot;open-options&quot;&gt;&lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt;&lt;/button&gt;
        &lt;ul&gt;
            &lt;li data-option=&quot;favorite&quot;&gt;
                &lt;span class=&quot;label&quot; title=&quot;Favorite&quot;&gt;
                    &lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt;
                    &lt;span class=&quot;visuallyhidden&quot;&gt;Favorite&lt;/span&gt;
                &lt;/span&gt;
                &lt;div class=&quot;panel&quot;&gt;
                    ...
                &lt;/div&gt;
            &lt;/li&gt;
            &lt;li data-option=&quot;share&quot;&gt;
                &lt;span class=&quot;label&quot; title=&quot;Share&quot;&gt;
                    &lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt;
                    &lt;span class=&quot;visuallyhidden&quot;&gt;Share&lt;/span&gt;
                &lt;/span&gt;
                &lt;div class=&quot;panel&quot;&gt;
                    ...
                &lt;/div&gt;
            &lt;/li&gt;
            &lt;li data-option=&quot;source&quot;&gt;
                &lt;span class=&quot;label&quot; title=&quot;Source&quot;&gt;
                    &lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt;
                    &lt;span class=&quot;visuallyhidden&quot;&gt;Source&lt;/span&gt;
                &lt;/span&gt;
                &lt;div class=&quot;panel&quot;&gt;
                    ...
                &lt;/div&gt;
            &lt;/li&gt;
            &lt;li data-option=&quot;author&quot;&gt;
                &lt;span class=&quot;label&quot; title=&quot;Author&quot;&gt;
                    &lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt;
                    &lt;span class=&quot;visuallyhidden&quot;&gt;Author&lt;/span&gt;
                &lt;/span&gt;
                &lt;div class=&quot;panel&quot;&gt;
                    ...
                &lt;/div&gt;
            &lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
    &lt;a class=&quot;expand&quot; href=&quot;...&quot;&gt;
        &lt;img class=&quot;svg action-expand&quot; src=&quot;...&quot; /&gt; &lt;span class=&quot;visuallyhidden&quot;&gt;Expand&lt;/span&gt;
        &lt;img class=&quot;svg action-collapse&quot; src=&quot;...&quot; /&gt; &lt;span class=&quot;visuallyhidden&quot;&gt;Collapse&lt;/span&gt;
    &lt;/a&gt;
&lt;/article&gt;
    </code></pre>
</article>