$.ajax({
  url: "../api/lists-products",
  type: "GET",
  dataType: "json",
  beforeSend: (e) => {
    Swal.fire({
      html: "Loading...",
      didOpen: () => {
        Swal.showLoading();
      },
    });
  },
  success: (data) => {
    Swal.close();

    $("#product-body").empty();

    $.each(data.products, (i, e) => {
      $("#product-body").append(`
    		<tr>
    			<td>${e.barcode_id}</td>
    			<td>${e.product_name}</td>
    			<td>${e.product_brand}</td>
    			<td>${e.product_location}</td>
    			<td>${e.product_qty}</td>
    			<td>
            <button class="btn btn-success barCode" data-barcodeid="${e.barcode_id}" >Barcode</button>
            <button class="btn btn-success addQty" data-barcodeid="${e.barcode_id}" >Add Quantity</button>
    				<button 
              class="btn btn-primary editProd" 
              data-id="${e.id}"
              data-name="${e.product_name}"
              data-brand="${e.product_brand}"
              data-location="${e.product_location}"
              >Edit</button>
    				<button class="btn btn-danger deleteProd" data-id="${e.id}">Delete</button>
    			</td>
    		</tr>
    	`);
    });

    $(".dataTable").DataTable();
  },
});

$(document).on("click", "#add-qty", () => {
  $.ajax({
    url: "../api/add-product-qty",
    type: "POST",
    dataType: "json",
    data: {
      id: $("#qty-modal").data("barcodeid"),
      qty: $("#a-qty").val(),
    },
    beforeSend: (e) => {
      Swal.fire({
        html: "Loading...",
        didOpen: () => {
          Swal.showLoading();
        },
      });
    },
    success: (data) => {
      Swal.close();

      Swal.fire({
        icon: "success",
        title: "Added Quantity succesfully.",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ok",
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      });
    },
  });
});

$(document).on("click", ".addQty", (e) => {
  $("#qty-modal").modal("show");
  $("#qty-modal").data("barcodeid", e.target.dataset.barcodeid);
});

$(document).on("click", ".deleteProd", (e) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../api/delete-product",
        type: "POST",
        dataType: "json",
        data: {
          id: e.target.dataset.id,
        },
        beforeSend: (e) => {
          Swal.fire({
            html: "Loading...",
            didOpen: () => {
              Swal.showLoading();
            },
          });
        },
        success: (data) => {
          Swal.close();

          Swal.fire({
            icon: "success",
            title: "Deleted succesfully.",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        },
      });
    }
  });
});

$(document).on("click", "#update-product", () => {
  $.ajax({
    url: "../api/update-product",
    type: "POST",
    dataType: "json",
    data: {
      product_name: $("#e-pname").val(),
      product_brand: $("#e-pbrand").val(),
      product_location: $("#e-ploc").val(),
      id: $("#edit-modal").data("id"),
    },
    beforeSend: (e) => {
      Swal.fire({
        html: "Loading...",
        didOpen: () => {
          Swal.showLoading();
        },
      });
    },
    success: (data) => {
      Swal.close();

      Swal.fire({
        icon: "success",
        title: "Update succesfully.",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ok",
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      });
    },
  });
});

$(document).on("click", ".editProd", (e) => {
  $("#edit-modal").modal("show");
  $("#edit-modal").data("id", e.target.dataset.id);
  $("#e-pname").val(e.target.dataset.name);
  $("#e-pbrand").val(e.target.dataset.brand);
  $("#e-ploc").val(e.target.dataset.location).change();
});

$(document).on("click", ".barCode", (e) => {
  $.ajax({
    url: "../generate.php",
    type: "POST",
    dataType: "json",
    data: {
      barcode: e.target.dataset.barcodeid,
    },
    beforeSend: (e) => {
      Swal.fire({
        html: "Loading...",
        didOpen: () => {
          Swal.showLoading();
        },
      });
    },
    success: (data) => {
      Swal.close();

      $("#bar-modal").modal("show");
      $("#barcode-body").empty().append(data.barcode);
    },
  });
});

$(document).on("click", "#insert-product", () => {
  $.ajax({
    url: "../api/insert-product",
    type: "POST",
    dataType: "json",
    data: {
      product_name: $("#pname").val(),
      product_brand: $("#pbrand").val(),
      product_location: $("#ploc").val(),
      product_qty: $("#pqty").val(),
    },
    beforeSend: (e) => {
      Swal.fire({
        html: "Loading...",
        didOpen: () => {
          Swal.showLoading();
        },
      });
    },
    success: (data) => {
      Swal.close();

      Swal.fire({
        icon: "success",
        title: "Added succesfully.",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ok",
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      });
    },
  });
});

$(document).on("click", "#add-product", () => {
  $("#add-modal").modal("show");
});
