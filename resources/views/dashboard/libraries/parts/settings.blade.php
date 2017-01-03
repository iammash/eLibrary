<?php
$user_id = $user->id;

if(isset($library) && is_object($library)){

    $route_name = route('dashboard.libraries.update', ['library_id' => $library->id]);
    $library_id          = $library->id;
    $library_name        = $library->name;
    $library_description = $library->description;

    $manager = \eLibrary\User::join('user_library', 'user_library.user_id', '=', 'users.id')
        ->where('user_library.library_id', '=', $library_id)
        ->where('user_library.access', '=', 'MANAGER')
        ->first();

    $owner = \eLibrary\User::join('user_library', 'user_library.user_id', '=', 'users.id')
        ->where('user_library.library_id', '=', $library_id)
        ->where('user_library.access', '=', 'OWNER')
        ->first();

    $ownersNmanagers = \eLibrary\LibraryMembership::whereNotIn('access', ['OWNER', 'MANAGER'])->pluck('user_id')->toArray();
    $users = \eLibrary\User::whereIn('id', $ownersNmanagers)->get();

} else {
    $users               = \eLibrary\User::where('id', '<>', $user->id)->get();
    $manager             = $users;
    $owner               = $users;
    $route_name          = route('dashboard.libraries.create');
    $library_name        = old('library_name');
    $library_description = old('library_description');
}
?>

<form id="create-library" method="post" action="{{ $route_name }}" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    @if(isset($library_id))
        <input type="hidden" name="library_id" value="{{ $library_id }}">
    @endif
    {{csrf_field()}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                <label for="library_name" class="pull-right">Name</label>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                <input class="form-control" type="text" name="library_name" id="library_name" value="{{ $library_name }}" placeholder="Library Name" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                <label for="library_description" class="pull-right">Description</label>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                <textarea class="form-control" name="library_description" id="library_description" >{{ $library_description }}</textarea>
            </div>
        </div>
    </div>
    @if(isset($library) && is_object($library))
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                <label for="library_members" class="pull-right">Owner</label>
            </div>
            <div class="col-sm-10 col-md-10 col-xs-10">
                @if($owner !== null && is_object($owner))
                    <input name="owner" class="form-control" disabled value="{{ $owner->getFullName() }}" />
                @else
                    <strong>None</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                <label for="library_members" class="pull-right">Manager</label>
            </div>
            <div class="col-sm-10 col-md-10 col-xs-10">
                @if($manager !== null && is_object($owner))
                    <input name="owner" class="form-control" disabled value="{{ $manager->getFullName() }}" />
                @else
                    <strong>None</strong>
                @endif
            </div>
        </div>
    </div>
    @endif
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                <label for="library_members" class="pull-right">Members</label>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                @if(count($users) > 0)
                <select id="library_members" name="library_members[]" multiple class="form-control">
                    @foreach($users as $user)
                        @if(isset($library_id) && \eLibrary\LibraryMembership::membershipExists($library_id, $user->id))
                            <option selected value="{{ $user->id }}">{{ $user->getFullName() }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->getFullName() }}</option>
                        @endif
                    @endforeach
                </select>
                @endif
                <p class="small">You can also add more members later.</p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                <hr/>
                <button id="submitEbook" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>