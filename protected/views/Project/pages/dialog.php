<md-dialog class="md-content-overflow">
	<md-toolbar>
		<div class="md-toolbar-tools">
			<h2>{{pjt.data.Name}}</h2>
		</div>
	</md-toolbar>
	<md-dialog-content>
		{{pjt.data.Description}}
	</md-dialog-content>
	<div class="md-actions">
		<md-button ng-click="pjt.projectTasks(pjt.data)">Tasks</md-button>
	</div>
</md-dialog>