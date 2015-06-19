<md-list ng-controller="projectController as pjt">
	<md-list-item class="md-2-line" ng-repeat="project in pjt.projects" ng-click="pjt.dialog($event)">
		<md-icon md-font-icon="flaticon-search6"></md-icon>
		<div class="md-list-item-text">
			<h3>{{project.Name}}</h3>
			<p>{{project.Description}}</p>
		</div>
	</md-list-item>
</md-list>