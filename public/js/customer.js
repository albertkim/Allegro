// This file will be loaded alongside the Customer page
var app = angular.module("Allegro", []);

$("#customerMenu").addClass("active");

$('#demo').pinterest_grid({
	no_columns: 3,
	padding_x: 10,
	padding_y: 10,
	margin_bottom: 50,
	single_column_breakpoint: 700
});