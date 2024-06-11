
<div class="container-fluid p-0">
	<h1 class="h3 mb-3"><strong>Products</strong></h1>
		<div class="row">

			<div class="card">
				<div class="card-header">
					<button class="btn btn-primary" id="add-product">Add Product</button>
				</div>
				<div class="card-body">
					<table class="table table-striped dataTable no-footer dtr-inline">
						<thead>
							<tr>
								<th>Barcode ID</th>
								<th>Item</th>
								<th>Details</th>
								<th>Location</th>
								<th>Qty</th>
								<th>Tools</th>
							</tr>
						</thead>
						<tbody id="product-body">
							
						</tbody>
					</table>
				</div>
			</div>

		</div>
</div>

<div class="modal fade" id="qty-modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add quantity to product.</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body m-3" >
		        <div class="form-group mb-3">
		        	<label>Quantity to add</label>
		        	<input type="number" class="form-control" id="a-qty" placeholder="Quantity to add">
		        </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="add-qty">Add Quantity</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="bar-modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Right Click and save the image to download.</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body m-3" >
				<center id="barcode-body">
					
				</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Product</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body m-3">
		        <div class="form-group mb-3">
		        	<label>Product Name</label>
		        	<input type="text" class="form-control" id="e-pname" placeholder="Product Name">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Product Brand</label>
		        	<input type="text" class="form-control" id="e-pbrand" placeholder="Product Brand">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Location</label>
		        	<select class="form-control" id="e-ploc">
		        		<option selected="" hidden="">Select Location</option>
		        		<option value="Laboratory 1">Laboratory 1</option>
		        		<option value="Laboratory 2">Laboratory 2</option>
		        		<option value="Laboratory 3">Laboratory 3</option>
		        	</select>
		        </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="update-product">Update Product</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add-modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Product</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body m-3">
		        <div class="form-group mb-3">
		        	<label>Product Name</label>
		        	<input type="text" class="form-control" id="pname" placeholder="Product Name">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Product Brand</label>
		        	<input type="text" class="form-control" id="pbrand" placeholder="Product Brand">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Product Quantity</label>
		        	<input type="number" class="form-control" id="pqty" placeholder="Product Quantity">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Location</label>
		        	<select class="form-control" id="ploc">
		        		<option selected="" hidden="">Select Location</option>
		        		<option value="Laboratory 1">Laboratory 1</option>
		        		<option value="Laboratory 2">Laboratory 2</option>
		        		<option value="Laboratory 3">Laboratory 3</option>
		        	</select>
		        </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="insert-product">Add Product</button>
			</div>
		</div>
	</div>
</div>