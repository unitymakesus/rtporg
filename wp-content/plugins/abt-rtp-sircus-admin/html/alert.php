<?php
wp_enqueue_script('ng-alert-svc', plugins_url() . '/abt-rtp-sircus-admin/js/app/services/alert.js', array('ng-app'));
wp_enqueue_script('ng-alert-ctrl', plugins_url() . '/abt-rtp-sircus-admin/js/app/controllers/alert-ctrl.js', array('ng-alert-svc', 'ng-app'));
?>

<div data-ng-controller="AlertCtrl">
	<div class="below-h2" data-ng-repeat="alert in alertSvc.getAlerts()" data-ng-class="alertSvc.cls(alert.type)"><p data-ng-bind="alert.message"></p></div>
</div>
