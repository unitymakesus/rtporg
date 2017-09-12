<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/4/14
 * Time: 10:18 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<div
    ng-app="SircusFeedViewer"
    ng-controller="SircusFeedSearchController"
    ng-init="init()"
>
    <section
        when-scrolled
        id="social-grid-section"
        class="source-sircus social-grid">
        <!-- Strategy based on http://stackoverflow.com/questions/16155542/dynamically-displaying-template-in-ng-repeat-directive-in-angularjs -->
        <article
            id="tile-{{item.id}}"
            ng-class="getClass(item)"
            ng-repeat="item in items"
            ng-include="getItemPartial(item)"
            item-background
            post-render
        >
        <!-- Dynamic section template used -->
        </article>

    </section>

    <div class="post error404 not-found source-local" ng-show="hasNoItems()">
        <div class="entry-content">
            <div class="alert-box info">{{ "Actually, we couldn't find anything. Try searching again."  | i18n }}</div>
        </div>
    </div>

    <div class="pagination social-pagination" ng-include="getPaginationPartial();" ng-hide="wait"></div>

    <div class="loading" id="social-grid-loading" ng-show="wait"><img ng-src="{{'plugin/g_preloader.gif' | imageuri }}" /></div>
</div>