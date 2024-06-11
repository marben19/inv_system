$.ajax({
  url: "../api/lists-transfered-products",
  type: "GET",
  dataType: "json",
  data: {
    location: 'TVET Office'
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

    $("#pproduct").empty().append(`
      <option value="" hidden selected>Select Product</option>
    `);
    $.each(data.products, (i, e) => {
      $("#pproduct").append(`
        <option value="${e.id}">${e.product}</option>
      `);
    });

    $("#css2-body").empty();

    $.each(data.transfered, (i, e) => {
      $("#css2-body").append(`
        <tr>
          <td><img src="../${e.img}" style="height: 100px; width: 100px;"></td>
          <td>${e.product}</td>
          <td>${e.description}</td>
          <td>${e.quantity}</td>
          <td>${e.status}</td>
          <td>${e.date_inserted}</td>
          <td>
            <button class="btn btn-primary edit"
              data-id="${e.id}"
              data-name="${e.product}"
              data-des="${e.description}"
              data-qty="${e.quantity}"
              data-status="${e.status}"
            >
              Edit
            </button>
            <button class="btn btn-danger delete"
              data-id="${e.id}"
            >
              Delete
            </button>
          </td>
        </tr>
      `);
    });

    $(".dataTable").DataTable();
  },
});

$(document).on("click", ".delete", (e) => {
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
        url: "../api/delete-product-location",
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
            title: "Deleted successfully.",
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

$(document).on("click", "#update-product", (e) => {
  $.ajax({
    url: "../api/update-product-location",
    type: "POST",
    dataType: "json",
    data: {
      id: $("#edit-modal").data("id"),
      image: $("input[name='image233']").prop("files")[0], 
      product: $("#ename").val(),
      description: $("#edes").val(),
      quantity: $("#eqty").val(),
      status: $("#estatus").val(),
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
        title: "Updated successfully.",
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

$(document).on("click", ".edit", (e) => {
  const target = $(e.currentTarget);
  $("#edit-modal").modal("show");
  $("#edit-modal").data("id", target.data("id"));
  $("#ename").val(e.target.dataset.name);
  $("#edes").val(e.target.dataset.des);
  $("#eqty").val(target.data("qty"));
  $("#estatus").val(target.data("status"));
  $("#title").text("Update Product " + target.data("name"));
});

$(document).on("click", "#insert-product", () => {
  $.ajax({
    url: "../api/insert-to-location",
    type: "POST",
    dataType: "json",
    data: {
      product_id: $("#pproduct").val(),
      quantity: $("#pqty").val(),
      location: 'TVET Office',
      status: $("#pstatus").val(),
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
        title: "Added successfully.",
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

function openPrintModal() {
  $("#print-modal").modal("show");
}

function printData(data, selectedDate) {
  $("#print-data-container").empty();

  if (data.transfered.length === 0) {
    $("#print-data-container").append(`
      <p>No data found for the selected date: ${selectedDate}</p>
    `);
    return;
  }

  $("#print-data-container").append(`
    <table class="table table-bordered table-striped custom-table">
      <thead class="table-dark">
        <tr>
          <th scope="col">Image</th>
          <th scope="col">Item</th>
          <th scope="col">Description</th>
          <th scope="col">Qty</th>
          <th scope="col">Status</th>
          <th scope="col">Date Inserted</th>
        </tr>
      </thead>
      <tbody id="print-table-body"></tbody>
    </table>
  `);

  data.transfered.forEach(function(item) {
    $("#print-table-body").append(`
      <tr>
        <td><img src="../${item.img}" style="height: 100px; width: 100px;" class="img-thumbnail"></td>
        <td>${item.product}</td>
        <td>${item.description}</td>
        <td>${item.quantity}</td>
        <td>${item.status}</td>
        <td>${item.date_inserted}</td>
      </tr>
    `);
  });
}

$("#print-button").click(function() {
  openPrintModal();
});

$("#confirm-print").click(function() {
  const selectedDate = $("#print-date").val();
  console.log("Selected date:", selectedDate); // Log the selected date
  $.ajax({
    url: "../api/lists-transfered-products",
    type: "GET",
    dataType: "json",
    data: {
      location: 'TVET Office',
      date: selectedDate
    },
    beforeSend: function() {
      Swal.fire({
        html: "Loading...",
        didOpen: () => {
          Swal.showLoading();
        },
      });
    },
    success: function(data) {
      Swal.close();
      console.log("Data received:", data); // Log the data received
      printData(data, selectedDate);
      printJS({
        printable: 'print-data-container',
        type: 'html',
        css: 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'
      });
    },
    error: function(xhr, status, error) {
      Swal.close();
      console.error("Error fetching data:", error); // Log the error
      console.error("Status:", status); // Log the status
      console.error("XHR:", xhr); // Log the XHR object
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'There was an error fetching the data.',
      });
    }
  });
});

$('#search-button').on('click', function() {
  // Handle search functionality
});
