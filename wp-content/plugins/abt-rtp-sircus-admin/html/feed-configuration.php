<?php wp_enqueue_script('ng-config-ctrl', plugins_url() . '/abt-rtp-sircus-admin/js/app/controllers/config-ctrl.js', array('ng-app')); ?>
<div class="wrap" data-ng-controller="ConfigCtrl" data-ng-init='init(<?php echo json_encode(array(
	'services' => array(
		array(
			'icon' => 'i_twitter.svg',
			'name' => 'Twitter',
			'key' => 'twitter',
		),
		array(
			'icon' => 'i_google.svg',
			'name' => 'Google+',
			'key' => 'googleplus',
		),
		array(
			'icon' => 'i_instagram.svg',
			'name' => 'Instagram',
			'key' => 'instagram',
		),
		array(
			'icon' => 'i_youtube.svg',
			'name' => 'Youtube',
			'key' => 'youtube',
		),
		array(
			'icon' => 'i_rss.svg',
			'name' => 'RSS',
			'key' => 'rss',
		),
	),
)); ?>)'>
	<h2>Feed Configuration</h2>
	<?php require_once 'alert.php'; ?>
	<hr>
	<p>Configure your feed by managing entries that are allowed or disallowed for each individual social media platform or RSS feed.</p>
	
	<section class="tabs">
		<h2 class="nav-tab-wrapper">
			<a data-ng-repeat="service in services" class="nav-tab" data-ng-class="{'nav-tab-active': service.key == config.service}" data-ng-click="setActiveService(service)"><img data-ng-src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/{{service.icon}}" /> {{service.name}}</a>
		</h2>
		<section id="config" class="tab-container active">
			<section class="col">
				<h3 class="title"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_checkmark.svg" /> Whitelist Users ({{(config.whitelist|filter:emptyFilterPredicate).length || 0}})</h3>
				<div class="container">
					<p><strong>Allow</strong> entries from the following:</p>
					<div class="field repeatable" data-ng-repeat="tag in config.whitelist track by $index">
						<label class="visuallyhidden" for="">User name</label>
						<input id="" type="text" placeholder="User name" data-ng-model="config.whitelist[$index]" data-ng-disabled="loading" />
						<button data-ng-class="{disabled:loading}" class="button-secondary" title="Add another entry" data-ng-click="addToArray(config.whitelist)" data-ng-disabled="loading"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_add.svg" /></button>
						<button data-ng-class="{disabled:loading}" class="button-secondary" title="Remove this entry" data-ng-click="removeFromArray(config.whitelist, $index)" data-ng-show="config.whitelist.length > 1" data-ng-disabled="loading"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_minus.svg" /></button>
					</div>
					<button type="button" class="button-primary" title="Save" data-ng-click="save(config, 'whitelist')">Save</button>
				</div>
			</section>
			<section class="col">
				<h3 class="title"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_not-allow.svg" /> Blacklist Users ({{(config.blacklist|filter:emptyFilterPredicate).length || 0}})</h3>
				<div class="container">
					<p><strong>Disallow</strong> entries from the following:</p>
					<div class="field repeatable" data-ng-repeat="tag in config.blacklist track by $index">
						<label class="visuallyhidden" for="">User name</label>
						<input id="" type="text" placeholder="User name" data-ng-model="config.blacklist[$index]" data-ng-disabled="loading" />
						<button data-ng-class="{disabled:loading}" class="button-secondary" title="Add another entry" data-ng-click="addToArray(config.blacklist)" data-ng-disabled="loading"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_add.svg" /></button>
						<button data-ng-class="{disabled:loading}" class="button-secondary" title="Remove this entry" data-ng-click="removeFromArray(config.blacklist, $index)" data-ng-show="config.blacklist.length > 1" data-ng-disabled="loading"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_minus.svg" /></button>
					</div>
					<button type="button" class="button-primary" title="Save" data-ng-click="save(config, 'blacklist')">Save</button>
				</div>
			</section>
			<section class="col">
				<h3 class="title"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_tag.svg" /> Tags ({{(config.tags|filter:emptyFilterPredicate).length || 0}})</h3>
				<div class="container">
					<p><strong>Allow</strong> entries from the following:</p>
					<div class="field repeatable" data-ng-repeat="tag in config.tags track by $index">
						<label class="visuallyhidden" for="">Tag</label>
						<input id="" type="text" placeholder="Tag" data-ng-model="config.tags[$index]" data-ng-disabled="loading" />
						<button data-ng-class="{disabled:loading}" class="button-secondary" title="Add another entry" data-ng-click="addToArray(config.tags)" data-ng-disabled="loading"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_add.svg" /></button>
						<button data-ng-class="{disabled:loading}" class="button-secondary" title="Remove this entry" data-ng-click="removeFromArray(config.tags, $index)" data-ng-show="config.tags.length > 1" data-ng-disabled="loading"><img src="<?php echo plugins_url(); ?>/abt-rtp-sircus-admin/img/i_minus.svg" /></button>
					</div>
					<button type="button" class="button-primary" title="Save" data-ng-click="save(config, 'tags')">Save</button>
				</div>
			</section>
		</section>
	</section>
</div>