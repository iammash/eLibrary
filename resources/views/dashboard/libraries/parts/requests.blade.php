<div class="table-responsive">
    <table class="table table-stripped table-bordered">
        <thead>
        <tr>
            <td>First name</td>
            <td>Last name</td>
            <td>Email</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @if($users->count() > 0)
            @foreach($users as $u)
                <tr>
                    <td>{{ $u->firstname }}</td>
                    <td>{{ $u->lastname }}</td>
                    <td>{{ $u->email }}</td>
                    <td class="text-center" width="10%">
                    @if(\eLibrary\Library::userCan('everything', $user->id, $library->id ))
                    <form method="post" action="{{ route('dashboard.libraries.approveaccess') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="library_id" value="{{ $library->id }}">
                        <input type="hidden" name="user_id" value="{{ $u->id }}">
                        <button onclick="return confirm('Are you sure you want to approve membership for {{ $u->firstname }} to this library?')"
                                class="btn btn-success">Approve
                        </button>
                    </form>
                    @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">No users found!</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>