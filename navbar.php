<!-- <nav class="navbar navbar-inverse">
		<div class="contaner-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><p class="text-warning"> ABCDEF COLLEGE </p></a>
			</div>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><p style="color:#cc8800;"><span class="glyphicon glyphicon-plus" ></span> Add <span class="caret"></span></p></a>
				<ul class="dropdown-menu">
					<li><a href="#"> Add Subject</p></a></li>
					<li><a href="#"> Add Faculty</a></li>
					<li><a href="#"> Add Section</a></li>
					<li><a href="#"> Add Course</a></li>
					<li><a href="#"> Add Department</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><p style="color: #cc8800;"><span class="glyphicon glyphicon-minus"></span> Delete <span class="caret"></span></p></a>
				<ul class="dropdown-menu">
					<li><a href="#"> Delete Subject</a></li>
					<li><a href="#"> Delete Faculty</a></li>
					<li><a href="#"> Delete Section</a></li>
					<li><a href="#"> Delete Course</a></li>
					<li><a href="#"> Delete Department</a></li>
				</ul>
			</li>
			<li><a href="#"><p style="color:#cc8800;"><span class="glyphicon glyphicon-font"></span>iwaii</p></a></li>
			<li><a href="#"><p style="color:#cc8800;"><span class="glyphicon glyphicon-bold"></span>laba</p></a></li>
		</ul>
	</nav> -->
<!--
<div id="container">
	<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #fff9e5; height: 100px; ">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><h1 style="font-size: 70px; margin-top: -10px; color: #996633;  ">WebSiteName</h1> </a>
			</div>
			<div>
				<ul class="nav navbar-nav navbar-right">
					<li id="menu"><a href="#"><span class="glyphicon glyphicon-menu-hamburger" onclick="sliding()" style="color:#996633;text-align: right; font-size: 25px; padding-top: 20px;"></span></a></li>
					<br>
				</ul>
			</div>
		</div>
	</nav>
	<div class="panel panel-warning" id="sidebar" style="width: 300px; margin-top: 100px; margin-right: 0; float: right;">
		<div class="panel-body" id="a" style="padding: 0;">
			<div class="btn-group-vertical btn-block">
				<a href="#" style="text-decoration: none"><button type="button" class="btn btn-warning btn-block" onclick="subslide1()" style="border-radius: 0;"><p style="font-size: 25px; font-weight: bold; text-align: left;">Add  <span class="glyphicon glyphicon-triangle-bottom" id="sp1" style="font-size: 15px; font-weight: lighter"></span></p></button></a>
				<div class="btn-group-vertical btn-block" id="sub1">
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Add Course</button>
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Add Department</button>
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Add Faculty</button>
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Add Section</button>
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Add Subject</button>
				</div>
				<a href="#" style="text-decoration: none"><button type="button" class="btn btn-warning btn-block" onclick="subslide2()" style="border-radius: 0;"><p style="font-size: 25px; font-weight: bold; text-align: left;"> Delete <span class="glyphicon glyphicon-triangle-bottom" id="sp2" style="font-size: 15px; font-weight: lighter""></span></p></button></a>
				<div class="btn-group-vertical btn-block" id="sub2" >
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Delete Course</button>
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Delete Department</button>
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Delete Faculty</button>
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Delete Section</button>
					<button type="button" class="btn btn-warning btn-block" style="font-size: 17px; text-align: right;"> Delete Subject</button>
				</div>
				<a href="#" style="text-decoration: none;"><button type="button" class="btn btn-warning btn-block" style="border-radius: 0;"><p style="font-size: 25px; font-weight: bold; text-align: left;">  Option 1</p></button></a>
				<a href="#" style="text-decoration: none;"><button type="button" class="btn btn-warning btn-block" style="border-radius: 0;"><p style="font-size: 25px; font-weight: bold; text-align: left;">  Option 2</p></button></a>
				<a href="#" style="text-decoration: none;"><button type="button" class="btn btn-warning btn-block" style="border-radius: 0;"><p style="font-size: 25px; font-weight: bold; text-align: left;">  Sign Out</p></button></a>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#sidebar").hide();
		$("#sub1").hide();
		$("#sub2").hide();
	});
	function sliding()
	{
		$("#sidebar").toggle();
	}
	function subslide1()
	{
		$("#sub1").toggle();
		if($("#sp1").hasClass("glyphicon-triangle-bottom"))
		{
			$("#sp1").removeClass("glyphicon-triangle-bottom");
			$("#sp1").addClass("glyphicon-triangle-top");
		}
		else
		{
			$("#sp1").removeClass("glyphicon-triangle-top");
			$("#sp1").addClass("glyphicon-triangle-bottom");
		}
	}
	function subslide2()
	{
		$("#sub2").toggle();
		if($("#sp2").hasClass("glyphicon-triangle-bottom"))
		{
			$("#sp2").removeClass("glyphicon-triangle-bottom");
			$("#sp2").addClass("glyphicon-triangle-top");
		}
		else
		{
			$("#sp2").removeClass("glyphicon-triangle-top");
			$("#sp2").addClass("glyphicon-triangle-bottom");
		}
	}
</script>
<style>
	a
	{
		text-decoration: none;
	}
</style>
-->