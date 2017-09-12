<div class="alignleft actions bulkactions">
	<select name="action" data-ng-model="serviceFilter" data-ng-disabled="loading">
		<option value="" selected="selected">Service Filter</option>
		<option value="twitter" class="hide-if-no-js">Twitter</option>
		<option value="googleplus" class="hide-if-no-js">Google+</option>
		<option value="instagram" class="hide-if-no-js">Instagram</option>
		<option value="youtube" class="hide-if-no-js">YouTube</option>
		<option value="rss" class="hide-if-no-js">RSS</option>
	</select>
	<input type="text" data-ng-model="searchFilter" placeholder="Type to search" />
	<input type="button" class="button action" value="Filter" data-ng-click="filterByService(serviceFilter, searchFilter)" data-ng-disabled="loading" />
</div>