<div class="container-fluid p-0">
	<h1 class="h3 mb-3"><strong>Print Tagging</strong></h1>
		<div class="row">

			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-4">
					        <div class="form-group mb-3">
					        	<label>Locations</label>
					        	<select class="form-control" id="locations">

					        	</select>
					        </div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-striped dataTable no-footer dtr-inline">
						<thead>
							<tr>
								<th>Invenory No.</th>
								<th>Product</th>
								<th>Description</th>
								<th>Location</th>
								<th>Date Issued</th>
								<th>Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="css2-body">
							
						</tbody>
					</table>
				</div>
			</div>

		</div>
</div>

<div class="modal fade" id="print-modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body m-3" id="printJS-form">

				<div style="width: 50%; height: 10%; padding: 10px; border: 1px dashed gray ">
				<img src="../img/icon.jpg" style="height: 50px; width: 70px; float: left;">
		        <center><h3 style="font-size: 12px;">Inventory Tag</h3></center>

		        <br>
		        <br>
		        <br>

		        <table class="table">
		        	<tbody>
		        	<tr>
		        		<td colspan="2">
		        			<label id="description" style="font-size: 10px;"></label>
		        		</td>

		        	</tr>
		        	<tr>
		        		<td colspan="2">
		        			<label id="serialno" style="font-size: 10px;"></label>
		        		</td>
		        	</tr>
		        	<tr>
		        		<td>
		        			<label id="issue" style="font-size: 10px;"></label>
		        		</td>
		        		<td>
		        			<label id="amount" style="float: right; font-size: 10px;"></label>
		        		</td>
		        	</tr>
		        	<tr>
		        		<td colspan="2">
		        			<label id="invent" style="font-size: 10px;"></label>
		        		</td>
		        	</tr>
		        	<tr>
		        		<td colspan="2">
		        			<label id="location" style="font-size: 10px;"></label>
		        		</td>
		        	</tr>
		        	</tbody>
		        </table>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="printJS({ printable: 'printJS-form', type: 'html', css: 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', maxWidth: '100' })">Print</button>
			</div>
		</div>
	</div>
</div>