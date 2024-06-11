<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>TVET</strong></h1>
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <button class="btn" id="add-product" style="background-color: #3B3F5C; background-image: linear-gradient(190deg, #3B3F5C 0%, #3A416F 100%); color: white;">Add Item to TVET</button>
                <button class="btn" id="print-button" onclick="openPrintModal()" style="background-color: #3B3F5C; background-image: linear-gradient(190deg, #3B3F5C 0%, #3A416F 100%); color: white; margin-left: 10px;">Print</button>
            </div>
            <div class="card-body">
					<table class="table table-striped dataTable no-footer dtr-inline">
						<thead>
							<tr>
								<th>Image</th>
								<th>Item</th>
								<th>Description</th>
								<th>Qty</th>
								<th>Status</th>
								<th>Date Inserted</th>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Date to Print</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <div class="form-group mb-3">
                    <label>Select Date:</label>
                    <input type="date" class="form-control" id="print-date">
                </div>
                <div id="print-data-container"></div> <!-- Added container for the print data -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm-print">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <div class="form-group mb-3">
                    <label for="class-name" class="form-label">Upload Image</label>
                    <input type="file" class="filepond-233" name="image233" data-allow-reorder="true" data-max-file-size="15MB" data-max-files="15"  />
                </div>  
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" id="ename" placeholder="Name">
                </div>
                <div class="form-group mb-3">
                    <label>Description</label>
                    <input type="text" class="form-control" id="edes" placeholder="Description">
                </div>
                <div class="form-group mb-3">
                    <label>Quantity</label>
                    <input type="number" class="form-control" id="eqty" placeholder="Quantity">
                </div>
                <div class="form-group mb-3">
                    <label>Status</label>
                    <select class="form-control" id="estatus">
                        <option selected="" hidden="">Select Status</option>
                        <option value="Functional">Functional</option>
                        <option value="Non-functional">Non-functional</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-product">Update</button>
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
		        	<label>Product</label>
		        	<select class="form-control" id="pproduct">

		        	</select>
		        </div>
		        <div class="form-group mb-3">
		        	<label>Quantity</label>
		        	<input type="number" class="form-control" id="pqty" placeholder="Product Quantity">
		        </div>
		        <div class="form-group mb-3">
		        	<label>Status</label>
		        	<select class="form-control" id="pstatus">
		        		<option selected="" hidden="">Select Status</option>
		        		<option value="Functional">Functional</option>
		        		<option value="Non-functional">Non-functional</option>
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