<!-- Modal -->
<div id="addMember" class="modal fade" role="dialog">
    <form action="{{ route('dashboard.libraries.addtolibrary') }}" class="modal-dialog" method="post">
        {{ csrf_field() }}
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Member to "{{ $library->name }}"</h4>
            </div>
            <div class="modal-body">

                @if( count($non_member_users) > 0 )

                    <div class="form-group">
                        <label>User</label>
                        <br/>
                        <select name="user_id" class="form-control">
                            @foreach($non_member_users as $u)
                                <option value="{{ $u->id }}">{{ $u->getFullName() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Access</label>
                        <br/>
                        <select name="access" class="form-control">
                            <option disabled selected>Select one...</option>
                            <option value="R">Read</option>
                            <option value="RW">Read + Write</option>
                        </select>
                    </div>

                    <input type="hidden" name="library_id" value="{{ $library->id }}">
                @else
                    <p>Hmmm! No users available for membership for this library.</p>
                @endif
            </div>
            <div class="modal-footer">
                @if( count($non_member_users) > 0 )
                <button type="submit" class="btn btn-success">Save</button>
                @endif
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
</div>