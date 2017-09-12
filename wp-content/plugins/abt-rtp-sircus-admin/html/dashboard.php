<?php
wp_enqueue_script('chartjs', plugins_url() . '/abt-rtp-sircus-admin/js/Chart.min.js');
wp_enqueue_script('ng-dash-ctrl', plugins_url() . '/abt-rtp-sircus-admin/js/app/controllers/dash-ctrl.js', array('ng-app'));
?>

<div class="wrap" data-ng-controller="DashCtrl">
	<h2>Dashboard</h2>
	<?php require_once 'alert.php'; ?>
	<hr>
	<p data-ng-show="loadingData"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/ajax-loader.gif" alt="..." /><span data-ng-bind="loadingMessage"></span></p>
	<div data-ng-hide="loadingData">
		<!-- approved/not approved breakdown -->
		<div class="col half stat-panel">
			<h3>Total Feed Items By Status</h3>
			<hr>
			<canvas id="approved-breakdown" width="300" height="300" chart="getApproved"></canvas>
			<hr>
			<ul class="key-legend">
				<li class="status-approved"><i></i> Approved</li>
				<li class="status-pending"><i></i> Pending</li>
				<li class="status-rejected"><i></i> Rejected</li>
			</ul>
		</div>

		<!-- # total by service  -->
		<div class="col half stat-panel">
			<h3>Total Feed Items By Service</h3>
			<hr>
			<canvas id="service-totals" width="300" height="300" chart="getFeedTotals"></canvas>
			<hr>
			<ul class="key-legend">
				<li class="service-twitter"><i></i> Twitter</li>
				<li class="service-google"><i></i> Google+</li>
				<li class="service-instagram"><i></i> Instagram</li>
				<li class="service-youtube"><i></i> Youtube</li>
				<li class="service-rss"><i></i> RSS</li>
			</ul>
		</div>

		<!-- # metrics by service  -->
		<div class="col half stat-panel">
			<h3>Item Breakdown</h3>
			<select data-ng-model="metric" data-ng-options="dimension for dimension in dimensions"></select>
			<hr>
			<canvas id="service-breakdown" width="600" height="300" chart="getServiceBreakdown" tag="metric"></canvas>
			<hr>
			<ul class="key-legend">
				<li class="service-twitter"><i></i> Twitter</li>
				<li class="service-google"><i></i> Google+</li>
				<li class="service-instagram"><i></i> Instagram</li>
				<li class="service-youtube"><i></i> Youtube</li>
				<li class="service-rss"><i></i> RSS</li>
			</ul>
		</div>
		<!-- # metrics by service  -->
		<div class="col half stat-panel">
			<h3>Service Template Breakdown</h3>
			<select data-ng-model="service" data-ng-options="serviceKey as serviceObj.name for (serviceKey, serviceObj) in serviceMap"></select>
			<hr>
			<canvas id="service-specific" width="600" height="300" chart="getTemplateBreakdown" tag="service"></canvas>
			<hr>
			<ul class="key-legend">
				<li class="service-twitter"><i></i> Twitter</li>
				<li class="service-google"><i></i> Google+</li>
				<li class="service-instagram"><i></i> Instagram</li>
				<li class="service-youtube"><i></i> Youtube</li>
				<li class="service-rss"><i></i> RSS</li>
			</ul>
		</div>
	</div>
</div>