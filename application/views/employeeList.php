<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
	<div class="panel panel-white">

		<div class="panel-heading panel-orange">
				<h4 class="panel-title">Click column Name to view in the List</h4>
			<div class="panel-tools">
				<div class="dropdown">
				<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
					<i class="fa fa-cog"></i>
				</a>
				<ul class="dropdown-menu dropdown-light pull-right" role="menu">
					<li>
						<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
					</li>
					<li>
						<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
					</li>
					<li>
						<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
					</li>
				</ul>
				</div>
			</div>
		</div>
		<div class="panel-body">
		    	<div class="alert alert-info">
		    	    <button data-dismiss="alert" class="close">×</button>
		    	    <h3 class="media-heading text-center">Welcome to Advance Employee List Area</h3>
		    	    <p class="media-timestamp">This is Advance Employee List Area. Here you can see any Employee details by click on particular check box, if you want to see all information
		    	  of any Employee then click on every checkbox.
        </p></div>
			<div class="row  space15">

			<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="sno" id="sno">
						SNo.
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="name" id="name2">
						Name
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="emp_no" id="username">
						Employee ID
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="job_title" id="job_title">
						Job Title
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="mobile" id="mobile">
						Mobile
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="address" id="address">
						Address
					</label>
				</div>
			</div>
			<div class="row  space15">
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="category" id="category">
						Category
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="dob" id="dob">
						Date Of Birth
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="job_category" id="job_category">
						Job Category
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="qualification" id="qualification">
						Qualification
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="experiance" id="experiance">
						Experience
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="email" id="email">
						Email
					</label>
				</div>
				<!-- <div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="status" id="status">
						Status
					</label>
				</div> -->
			</div>
			<div class="row  space10">
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="city" id="city">
						City
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="state" id="state">
						State
					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="pin_code" id="pin_code">
						PIN Code
					</label>
				</div>
				<!-- <div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="phone" id="phone">
						Phone
					</label>
				</div> -->
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="join_date" id="join_date">

						Joining Date

					</label>
				</div>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" name="chk[]" value="gender" id="gender">
						Gender
					</label>
				</div>
			</div>
		</div>
	</div>
	<!-- end: INLINE TABS PANEL -->
	</div>
</div>
<!-- end: PAGE CONTENT-->
<div class="row" id="dynamicEmployeeList">

</div>