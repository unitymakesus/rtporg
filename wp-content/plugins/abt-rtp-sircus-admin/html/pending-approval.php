<?php wp_enqueue_script('ng-page-ctrl', plugins_url() . '/abt-rtp-sircus-admin/js/app/controllers/page-ctrl.js', array('ng-app')); ?>
<?php wp_enqueue_script('ng-pending-ctrl', plugins_url() . '/abt-rtp-sircus-admin/js/app/controllers/pending-ctrl.js', array('ng-page-ctrl')); ?>
<div class="wrap" data-ng-controller="PageCtrl" data-ng-init='init(<?php echo json_encode(array('approved' => 0)); ?>)'>
	<div data-ng-controller="PendingCtrl">
		<h2>Pending Approval</h2>
		<?php require_once 'alert.php'; ?>
		<hr>
		<p>The following entries are <strong>awaiting approval</strong> and are not currently displayed on the site.</p>
		<div class="tablenav top" data-ng-show="meta">
			<?php include 'pagination-buttons.php'; ?>
			<div class="alignleft actions bulkactions">
				<select name="action" data-ng-disabled="batchInProgress" data-ng-model="selectedAction">
					<option value="" selected="selected">Bulk Actions</option>
					<option value="approve" class="hide-if-no-js">Approve</option>
					<option value="reject" class="hide-if-no-js">Reject</option>
				</select>
				<input type="button" class="button action" value="Apply" data-ng-click="doBulkAction(selectedAction, selections, results)" data-ng-disabled="batchInProgress || !somethingToApply(selections) || !selectedAction" />
			</div>
			<?php include 'service-filter.php'; ?>
		</div>

		<table class="wp-list-table widefat fixed posts">
			<thead>
				<tr>
					<th scope="col" class="check-column"><input type="checkbox" data-ng-model="selectAll" data-ng-disabled="batchInProgress" /></th>
					<th scope="col" class="entry-photo"><span>Image</span></th>
					<th scope="col" class=""><span>Title</span></th>
					<th scope="col" class=""><span>Author</span></th>
					<th scope="col" class=""><span>Date</span></th>
					<th scope="col" class=""><span>Actions</span></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th scope="col" class="check-column"><input type="checkbox" data-ng-model="selectAll" data-ng-disabled="batchInProgress" /></th>
					<th scope="col" class="entry-photo"><span>Image</span></th>
					<th scope="col" class=""><span>Title</span></th>
					<th scope="col" class=""><span>Author</span></th>
					<th scope="col" class=""><span>Date</span></th>
					<th scope="col" class=""><span>Actions</span></th>
				</tr>
			</tfoot>
			<tbody>
				<tr class="hentry" data-ng-class="{'alternate':$even}" data-ng-repeat="result in results" data-ng-hide="loading">
					<th class="check-column"><input type="checkbox" data-ng-model="selections[result.id]" data-ng-disabled="batchInProgress" /></th>
					<td class="entry-photo"><img data-ng-src="{{getItemMedia(result, '<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/g_no-photo.png')}}" /></td>
					<td><a class="row-title" data-ng-href="{{result.fields.link}}" title="View Source" target="_blank" data-ng-bind="result.fields.item_text"></a></td>
					<td data-ng-bind="getAuthor(result.fields.item_author).name"></td>
					<td>{{(result.fields.created_ts * 1000)|date:'short'}} <br> Pending Approval</td>
					<td><button class="button-primary" data-ng-click="approve(result, $index)" data-ng-disabled="result.operating || (batchInProgress && selections[result.id])">Approve</button> <button class="button-secondary" data-ng-click="reject(result, $index)" data-ng-disabled="result.operating || (batchInProgress && selections[result.id])">Remove</button></td>
				</tr>
				<tr class="hentry" data-ng-show="loading && loadPaused">
					<td colspan="6"><em>Please wait while the system updates <img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/ajax-loader.gif" /></em></td>
				</tr>
				<tr class="hentry" data-ng-show="loading && !loadPaused">
					<td colspan="6"><em>Loading feed items <img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/ajax-loader.gif" /></em></td>
				</tr>
				<tr>
					<td colspan="6" data-ng-show="!loading && !results.length"><em>No results to display</em></td>
				</tr>
			</tbody>
		</table>
		<div class="tablenav bottom" data-ng-show="meta">
			<?php include 'pagination-buttons.php'; ?>
		</div>
	</div>
</div>