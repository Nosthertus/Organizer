<h1 class="md-display-1">Projects</h1>
<md-list ng-controller="projectController as pjt">
	<md-list-item class="md-2-line" ng-repeat="project in pjt.projects" ng-click="pjt.dialog($event, project)">
		<md-icon md-font-icon="flaticon-arrow73"></md-icon>
		<div class="md-list-item-text">
			<h3>{{project.Name}}</h3>
			<h4>{{project.Creator}}</h4>
			<p>{{project.Description}}</p>
		</div>
	</md-list-item>
</md-list>