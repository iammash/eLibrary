<div>
    <table class="table table-stripped table-bordered">
        <thead>
            <tr>
                <td>User ID</td>
                <td>First name</td>
                <td>Last name</td>
                <td>Email</td>
                <td>Is admin?</td>
                <td>Registered on</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        @if($users->count() > 0)
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin == 1 ? 'Yes' : 'No' }}</td>
                <td>{{ $user->created_at }}</td>
                <td class="text-center" width="10%">
                    <form action="{{ route('dashboard.users.deleteuser') }}" method="POST">
                         <div class="dropdown">
                                <button class="btn btn-flat btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cogs"></i>
                                    <span class="caret"></span>
                                </button>

                                {{ csrf_field() }}
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="" href="">Manage</a>
                                    </li>
                                    <li>
                                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                                        <button class="clear-btn" type="submit"
                                                onclick="return confirm('Are you sure you want to delete this member?')"
                                                style="color: red;">Delete</button>
                                    </li>
                                </ul>
                         </div>
                    </form>
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