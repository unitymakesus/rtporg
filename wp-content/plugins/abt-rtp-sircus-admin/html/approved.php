<?php wp_enqueue_script('ng-page-ctrl', plugins_url() . '/abt-rtp-sircus-admin/js/app/controllers/page-ctrl.js', array('ng-app')); ?>
<?php wp_enqueue_script('ng-approved-ctrl', plugins_url() . '/abt-rtp-sircus-admin/js/app/controllers/approved-ctrl.js', array('ng-app')); ?>
<div class="wrap" data-ng-controller="PageCtrl" data-ng-init='init(<?php echo json_encode(array('approved' => 1)); ?>)'>
	<h2>Approved Entries</h2>
	<?php require_once 'alert.php'; ?>
	<hr>
	<p>The following entries are <strong>approved</strong> and are currently displayed on the site.</p>

	<div class="tablenav top" data-ng-show="meta">
		<?php include 'pagination-buttons.php'; ?>
		<?php include 'service-filter.php'; ?>
	</div>
	<table class="wp-list-table widefat fixed posts">
		<thead>
			<tr>
				<th scope="col" class="entry-position"><span>Position</span></th>
				<th scope="col" class="entry-photo"><span>Image</span></th>
				<th scope="col" class=""><span>Title</span></th>
				<th scope="col" class=""><span>Author</span></th>
				<th scope="col" class=""><span>Date</span></th>				
				<th scope="col" class="entry-score"><span>Score</span></th>
				<th scope="col" class="entry-actions"><span>Actions</span></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th scope="col" class="entry-position"><span>Position</span></th>
				<th scope="col" class="entry-photo"><span>Image</span></th>
				<th scope="col" class=""><span>Title</span></th>
				<th scope="col" class=""><span>Author</span></th>
				<th scope="col" class=""><span>Date</span></th>				
				<th scope="col" class="entry-score"><span>Score</span></th>
				<th scope="col" class="entry-actions"><span>Actions</span></th>
			</tr>
		</tfoot>
		<tbody data-ng-controller="ApprovedCtrl">
			<tr class="hentry" data-ng-show="loading">
				<td colspan="7"><em>Page is loading</em></td>
			</tr>
			<tr>
				<td colspan="7" data-ng-show="!loading && !results.length"><em>No results to display</em></td>
			</tr>
			<tr class="hentry approved" data-ng-class="{'alternate':$even}" data-ng-repeat="result in getProcessedItems(results)" data-ng-hide="loading">
				<td class="entry-position">
					<div><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_lock.svg" data-ng-show="result.fields.locked" /> {{serverRankToDisplayRank(result.fields.rank) || 'Unranked'}}</div>
					<hr>
					<label class="visuallyhidden" for="">Lock Position:</label>
					<select data-ng-disabled="locking" data-ng-model="result.lockedRank" data-ng-options="rankObj.rank as rankObj.label for rankObj in getAvailableRanks(result, lockableRanks)" data-ng-change="toggleLockStatus(result, $index)">
						<option>-</option>
					</select>
					<hr>
					<button ng-click="setFeatured(result)" ng-hide="result.fields.featured == 1" class="button-secondary not-featured"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_featured-empty.svg" /></button>
					<button ng-click="unsetFeatured(result)" ng-show="result.fields.featured == 1" class="button-primary featured"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_featured.svg" /></button>


				</td>
				<td class="entry-photo"><img data-ng-src="{{getItemMedia(result, '<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/g_no-photo.png')}}" /></td>
				<td><a class="row-title" data-ng-href="{{result.fields.link}}" title="View Source" target="_blank" data-ng-bind="result.fields.item_text"></a></td>
				<td data-ng-bind="getAuthor(result.fields.item_author).name"></td>
				<td>{{(result.fields.created_ts * 1000)|date:'short'}} <br> Published</td>
				<td class="entry-score">
					<div class="action-bar">
						<button class="boost" title="Boost (+10)" data-ng-click="boostScore(result, $index, result.fields.boost_score + 10)" data-ng-disabled="boosting"><span>»</span></button>
						<button class="like" title="Like (+1)" data-ng-click="boostScore(result, $index, result.fields.boost_score + 1)" data-ng-disabled="boosting"><span>›</span></button>
						<div class="score"><span data-ng-bind="result.fields.boost_score" data-ng-hide="boosting"></span><span data-ng-show="boosting"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/ajax-loader.gif" alt="..." /></span></div>
						<button class="dislike" title="Dislike (-1)" data-ng-click="boostScore(result, $index, result.fields.boost_score - 1)" data-ng-disabled="boosting"><span>‹</span></button>
						<button class="bury" title="Bury (-10)" data-ng-click="boostScore(result, $index, result.fields.boost_score - 10)" data-ng-disabled="boosting"><span>«</span></button>
					</div>
				</td>
				<td class="entry-actions"><button class="button-secondary" data-ng-click="unapprove(result, $index)">Unpublish</button></td>
			</tr>
		</tbody>		
	</table>
	<div class="tablenav bottom" data-ng-show="meta">
		<?php include 'pagination-buttons.php'; ?>
		<?php include 'service-filter.php'; ?>
	</div>
</div>