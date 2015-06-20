<div ng-controller="taskController as tsk" layout-fill>
	<h3 class="md-headline">{{tsk.project.Name}}</h3>
	<h4>{{tsk.project.Creator}}</h4>

	<md-list>
		<md-list-item class="md-2-line" ng-repeat="task in tsk.tasks">
			<md-icon md-font-icon="flaticon-search6"></md-icon>
			<div class="md-list-item-text">
				<h3>{{task.Name}}</h3>
				<p>{{task.Description}}</p>
			</div>
		</md-list-item>
	</md-list>
</div>
