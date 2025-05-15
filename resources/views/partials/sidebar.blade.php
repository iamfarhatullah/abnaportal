	<nav id="sidebar">
		<div class="user-panel">
			<table>
				<tr>
					<td>
						<img src="https://w7.pngwing.com/pngs/81/570/png-transparent-profile-logo-computer-icons-user-user-blue-heroes-logo-thumbnail.png" class="img-circle img-responsive" width="56px" height="56px">
					</td>
					<td>
						<h5 class="to-hide ellipse">{{ auth()->user()->name }} <br><span>Admin</span></h5>
					</td>
				</tr>
			</table>
		</div>
		<div class="sidebar-links">
			<div data-toggle="tooltip" data-placement="right" title="Dashboard">
				<a href="{{ route('dashboard')}}" class="active-sidebar-link">
					<i class="fa fa-tachometer-alt"></i>
					<span class="to-hide">Dashboard <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Students">
				<a href="{{route('students.index')}}">
					<i class="fas fa-user-graduate"></i>
					<span class="to-hide">Students <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Commissions">
				<a href="{{route('commissions.index')}}">
					<i class="fas fa-pound-sign"></i>
					<span class="to-hide">Commissions <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Universities">
				<a href="{{route('universities.index')}}">
					<i class="fas fa-university"></i>
					<span class="to-hide">Universities <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Emails">
				<a href="{{route('emails.index')}}">
					<i class="fas fa-envelope"></i>
					<span class="to-hide">Emails <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Portals">
				<a href="{{route('portals.index')}}">
					<i class="fas fa-window-restore"></i>
					<span class="to-hide">Portals <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>
			</div>

			<div data-toggle="tooltip" data-placement="right" title="Profile">
				<a href="{{route('profile.index')}}">
					<i class="far fa-user"></i>
					<span class="to-hide">Profile <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>
			</div>
			<div data-toggle="tooltip" data-placement="right" title="Logout">
				<a href="javascript:void(0)" id="logout-link">
					<i class="fa fa-sign-out-alt"></i>
					<span class="to-hide">Logout <i class="fa fa-angle-right pull-right angle-icon"></i></span>
				</a>
			</div>
		</div>
		<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
			@csrf
			<button type="submit" style="display: none;"></button>
		</form>
	</nav>

	<script>
		document.getElementById('logout-link').addEventListener('click', function(event) {
			event.preventDefault(); // Prevent the default action (link navigation)
			document.getElementById('logout-form').submit(); // Submit the form
		});
	</script>