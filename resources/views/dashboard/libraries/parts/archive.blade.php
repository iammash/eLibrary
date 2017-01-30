<table id="librariesTable" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th class="text-center">Description</th>
        <th class="text-center">Created</th>
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if($libraries->count() > 0)
        @foreach($libraries as $library)
            <tr>
                <td>{{ $library->name }}</td>
                <td class="text-center">{{ $library->description }}</td>
                <td class="text-center">{{ $library->created_at->diffForHumans() }}</td>
                <td class="text-center" width="10%">
                    <div class="dropdown">
                        <button class="btn btn-flat btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cogs"></i>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('dashboard.libraries.view', ['library_id' => $library->id]) }}">View Books</a></li>
                            <li><a href="{{ route('dashboard.libraries.edit', ['library_id' => $library->id]) }}">Manage</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4">You are not member to any library or do not own any library.
                Please create some by navigating to <strong>"Sidebar" > "Libraries" > "Add new library"</strong> </td>
        </tr>
    @endif
    </tbody>
</table>