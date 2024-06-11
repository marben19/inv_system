<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Purchased</strong></h1>
    <div class="row">      
        <div class="card">
         <div class="card-header d-flex justify-content-start">
            <button class="btn" id="add-product" style="background-color: #3B3F5C; background-image: linear-gradient(190deg, #3B3F5C 0%, #3A416F 100%); color: white;">Add Purchased Product</button>
            </div>
            <div class="card-body">
					<table class="table table-striped dataTable no-footer dtr-inline">
						<thead>
							<tr>
								<th>Img</th>
								<th>Item</th>
								<th>Description</th>
								<th>Amount</th>
								<th>Serial Number</th>
								<th>Qty</th>
								<th>Category</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="purchased-body">
							
						</tbody>
					</table>
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
                    <input type="text" class="form-control" id="ename" placeholder="Product Name">
                </div>
                <div class="form-group mb-3">
                    <label>Product Descriptions</label>
                    <input type="text" class="form-control" id="edes" placeholder="Product Description">
                </div>
                <div class="form-group mb-3">
                    <label>Product Serial Number</label>
                    <input type="text" class="form-control" id="eserial" placeholder="Product Serial Number">
                </div>
                <div class="form-group mb-3">
                    <label>Product Quantity</label>
                    <input type="number" class="form-control" id="eqty" placeholder="Product Quantity">
                </div>
                <div class="form-group mb-3">
                    <label>Product Amount</label>
                    <input type="number" class="form-control" id="eamount" placeholder="Product Amount">
                </div>
                <div class="form-group mb-3">
                    <label>Product Category</label>
                    <select class="form-control" id="ecat">
                        <option selected="" hidden="">Select Category</option>
                        <option value="Tool">Tool</option>
                        <option value="Equipment">Equipment</option>
                        <option value="Consumable">Consumable</option>
                        <option value="Application/Software">Application/Software</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for=>Image</label>
                    <input type="file" class="form-control" id="eimage"placeholder="Image">
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
				  <label for="class-name" class="form-label">Upload Image</label>
				  <input type="file" class="filepond-233" name="image233" data-allow-reorder="true" data-max-file-size="15MB" data-max-files="15"  />
				</div>	
		        <div class="form-group mb-3">
		        	<label>Product Name</label>
		        	<input type="text" class="form-control" id="pname" placeholder="Product Name">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Product Description</label>
		        	<input type="text" class="form-control" id="pdes" placeholder="Product Description">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Product Serial Number</label>
		        	<input type="text" class="form-control" id="pserial" placeholder="Product Serial Number" readonly="">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Product Quantity</label>
		        	<input type="number" class="form-control" id="pqty" placeholder="Product Quantity">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Product Amount</label>
		        	<input type="number" class="form-control" id="pamount" placeholder="Product Amount">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Product Category</label>
		        	<select class="form-control" id="pcat">
		        		<option selected="" hidden="">Select Category </option>
		        		<option value="Tool">Tool</option>
		        		<option value="Equipment">Equipment</option>
		        		<option value="Consumable">Consumable</option>
		        		<option value="Application/Software">Application/Software</option>
		        	</select>
		        </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="insert-product" data-url="0">Add Product</button>
			</div>
		</div>
	</div>
</div>