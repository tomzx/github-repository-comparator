<html data-ng-app="grcApp">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-param" content="_token"/>
	<meta name="csrf-token" content="{{csrf_token()}}"/>
	<title>GitHub Repository Comparator</title>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}"></link>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-theme.min.css')}}"></link>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}"></link>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/dataTables.bootstrap.css')}}"></link>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/app.css')}}"></link>
</head>
<body data-ng-controller="HomeController">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{route('homepage')}}">GitHub Repository Comparator</a>
			</div>
			{{--<div id="navbar" class="navbar-collapse collapse">--}}
				{{--<form class="navbar-form navbar-right">--}}
					{{--<div class="form-group">--}}
						{{--<input type="text" placeholder="Repository" class="form-control">--}}
					{{--</div>--}}
					{{--<button type="submit" class="btn btn-success">Search</button>--}}
				{{--</form>--}}
			{{--</div>--}}
		</div>
	</nav>

	<div class="container-fluid main">
		@include('notices')

		<div class="row">
			<div class="col-sm-12">
				{{--<table data-datatable="" data-dt-options="HomeController.dtOptions" data-dt-columns="HomeController.dtColumns" class="row-border hover"></table>--}}
				<table class="table table-bordered datatable">
					<colgroup>
						<col style="width: 25px;"/>
						<col/>
						<col/>
						<col/>
						<col/>
						<col/>
						<col/>
						<col/>
					</colgroup>
					<thead>
						<tr>
							<th></th>
							<th>Repository</th>
							<th>Watch</th>
							<th>Stars</th>
							<th>Forks</th>
							<th>Last commit</th>
							<th>Open issues</th>
							<th>Open PR</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($repositories as $repository)
						<tr>
							<td class="text-center">
								<a href="{{route('remove', [$repository['full_name']])}}" class="btn btn-warning" data-method="delete"><i class="fa fa-trash-o"></i></a>
							</td>
							<td><a href="{{$repository['html_url']}}">{{$repository['full_name']}}</a></td>
							<td>{{$repository['subscribers_count']}}</td>
							<td>{{$repository['stargazers_count']}}</td>
							<td>{{$repository['forks_count']}}</td>
							<td>{{$repository['pushed_at']}}</td>
							<td>{{$repository['_grc']['open_issues_count']}}</td>
							<td>{{$repository['_grc']['pulls_count']}}</td>
						</tr>
						@endforeach
					</tbody>
					<tfooter>
						<tr>
							<td colspan="8">
								{{--<form action="{{url('/add')}}" method="post" class="form-inline">--}}
								{!!Form::open(['class' => 'form-inline'])!!}
									<input type="text" class="form-control" name="repository" placeholder="Repository"/>
									<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
								{{--</form>--}}
								{!!Form::close()!!}
							</td>
						</tr>
					</tfooter>
				</table>
			</div>
		</div>
	</div>

	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/dataTables.bootstrap.js')}}"></script>
	<script src="{{asset('assets/js/angular.min.js')}}"></script>
	<script src="{{asset('assets/js/angular-datatables.min.js')}}"></script>
	<script src="{{asset('assets/js/rails.js')}}"></script>
	<script src="{{asset('assets/js/app.js')}}"></script>
</body>
</html>
