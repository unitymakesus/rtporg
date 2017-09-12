<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/4/14
 * Time: 10:18 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php // TODO: Change ng-controller to SircusFeedListController ?>
<div
    ng-app="SircusFeedViewer"
    ng-controller="SircusFeedListController"
    ng-init="init({type:'list'})"
    when-scrolled
>
    <div id="tag-filter" class="tag-filter">
        <h3 class="toggle">
            <img class="svg"  ng-src="{{'plugin/icons/i_eye.svg' | imageuri }}" />
            {{ "Discover" | i18n }}
        </h3>
        <ul class="options">
            <li>
                <a ng-click="changeTag(false)" class="tag" ng-show="tag">{{ "Clear Filter" | i18n }}</a>
            </li>
            <li ng-repeat="tag in tags" ng-class="{active: isCurrentTag(tag)}">
                <a ng-click="changeTag(tag)" class="tag">#{{tag}}</a>
            </li>
        </ul>
    </div>
    <div data-ng-repeat-start="set in sets" data-ng-init="item = set.banner" data-ng-include="getItemPartial(item)" data-ng-class="getClass(item)">
    </div>
    <section data-ng-repeat-end id="social-grid-section" class="source-sircus social-grid" data-ng-controller="SetCtrl">
        <?php /* Strategy based on http://stackoverflow.com/questions/16155542/dynamically-displaying-template-in-ng-repeat-directive-in-angularjs */ ?>
        <article
            id="tile-{{item.id}}"
            data-ng-class="getClass(item)"
            data-ng-repeat="item in set.items track by $index"
            data-ng-include="getItemPartial(item)"
            item-background
            post-render
            data-ng-mouseleave="item.showOptions = false"
        >
        </article>
    </section>
    <button class="secondary view-more" id="social-grid-load-more" ng-show="!scroll.isEnabled()" ng-click="loadMore()">{{ "See More" | i18n }}</button>
    <div class="loading" id="social-grid-loading" ng-show="wait"><img ng-src="{{'plugin/g_preloader.gif' | imageuri }}" /></div>
</div>