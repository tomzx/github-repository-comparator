var grcApp = angular.module('grcApp', ['datatables']);

grcApp.controller('HomeController', function($scope, DTOptionsBuilder, DTColumnBuilder) {
	var vm = this;
	vm.dtOptions = DTOptionsBuilder.fromSource('data.json').withPaginationType('full_numbers');
	vm.dtColumns = [
		DTColumnBuilder.newColumn('watch').withTitle('Watch'),
		DTColumnBuilder.newColumn('stars').withTitle('Stars'),
		DTColumnBuilder.newColumn('forks').withTitle('Forks'),
		DTColumnBuilder.newColumn('last_commit').withTitle('Last commit (main branch)'),
		DTColumnBuilder.newColumn('open_issues').withTitle('Open issues'),
		DTColumnBuilder.newColumn('open_pr').withTitle('Open PR'),
	];
});

$(document).ready(function() {
	$('.datatable').DataTable();
});

