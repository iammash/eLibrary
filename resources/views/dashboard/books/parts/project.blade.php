<div class="small-box bg-aqua">
    <div class="inner">
        <h3>{{ $project->completedPercentage() }}%</h3>
        <p>{{ $project->title }}</p>
    </div>
    <div class="icon">
        <i class="ion ion-paperclip"></i>
    </div>
    <a href="{{ route('dashboard.projects.show', ['project_id' => $project->id ])  }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>