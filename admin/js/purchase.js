
function getLastSerialNumber() {
  let lastSerial = localStorage.getItem('lastSerialNumber');
  return lastSerial ? parseInt(lastSerial, 10) : 20000; 
}


function getNextSerialNumber() {
  let lastSerial = getLastSerialNumber();
  let nextSerial = lastSerial + 1;
  localStorage.setItem('lastSerialNumber', nextSerial);
  return nextSerial;
}



$("#pserial").val(getNextSerialNumber());


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

    $("#purchased-body").empty();

    $.each(data.products, (i, e) => {
      $("#purchased-body").append(`
        <tr>
          <td><img src="../${e.img}" style="height: 100px; width: 100px;"></td>
          <td>${e.product}</td>
          <td>${e.description}</td>
          <td>${e.amount}</td>
          <td>${e.serial_no}</td>
          <td>${e.quantity}</td>
          <td>${e.category}</td>
          <td>${e.date_purchased}</td>
          <td>
            <button 
              class="btn btn-primary editProd" 
              data-id="${e.id}"
              data-amount="${e.amount}"
              data-serial="${e.serial_no}"
              data-quantity="${e.quantity}"
              data-cat="${e.category}"
              data-Img="${e.image}"
              >Edit</button>
            <button class="btn btn-danger deleteProd" data-id="${e.id}">Delete</button>
          </td>
        </tr>
      `);
    });

    $(".dataTable").DataTable();
  },
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
      product: $("#ename").val(),
      description: $("#edes").val(),
      serial_no: $("#eserial").val(),
      quantity: $("#eqty").val(),
      amount: $("#eamount").val(),
      id: $("#edit-modal").data("id"),
      category: $("#ecat").val(),
      Img: $("#eimage").val(),
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
  $("#eserial").val(e.target.dataset.serial);
  $("#eqty").val(e.target.dataset.quantity);
  $("#eamount").val(e.target.dataset.amount);
  $("#ecat").val(e.target.dataset.cat);
  $("#eimage").val( e.target.dataset.Img);
});

$(document).on("click", "#add-product", () => {

  $("#add-modal").modal("show");

  FilePond.registerPlugin(
    // encodes the file as base64 data
    FilePondPluginFileEncode,
    
    // validates files based on input type
    FilePondPluginFileValidateType,
    
    // corrects mobile image orientation
    FilePondPluginImageExifOrientation,
    
    // previews the image
    
    // crops the image to a certain aspect ratio
    FilePondPluginImageCrop,
    
    // resizes the image to fit a certain size
    FilePondPluginImageResize,
    
    // applies crop and resize information on the client
    FilePondPluginImageTransform
  );

      // Select the file input and use create() to turn it into a pond
  var specupload = FilePond.create(
    document.querySelector('.filepond-233'),
    {
    labelIdle: `Drag & Drop your files or <span class="filepond--label-action">Browse</span>`
    }
  );

   FilePond.setOptions({
    server: {
    url: "",
    timeout: 60000,
    process: {
          url: '../api/insert-image',
          method: 'POST',
          withCredentials: false,
          onload: (response) => {

          let obj = JSON.parse(response); 

          $("#insert-product").attr("data-url", obj.dir);



          },
      },
      
  },
  });

  document.addEventListener('FilePond:processfiles', (e) => {

  

  });


});


$(document).on("click", "#insert-product", (e) => {
  $.ajax({
    url: "../api/insert-product",
    type: "POST",
    dataType: "json",
    data: {
      product: $("#pname").val(),
      description: $("#pdes").val(),
      serial_no: $("#pserial").val(),
      quantity: $("#pqty").val(),
      amount: $("#pamount").val(),
      category: $("#pcat").val(),
      img: e.target.dataset.url
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

document.getElementById("print-button").addEventListener("click", function() {
  $('#print-modal').modal('show');
});
function openPrintModal() {
  $('#print-modal').modal('show');
}


  function openPrintModal() {
    // Show the print modal
    $('#print-modal').modal('show');
    
    // When the "Print" button in the modal is clicked
    document.getElementById("confirm-print").addEventListener("click", function() {
        // Get the selected date
        var selectedDate = document.getElementById("print-date").value;
        
        // Call the function to print the selected date along with the CSS1 table data
        printSelectedDate(selectedDate);
    });
}

// Function to print the selected date along with the CSS1 table data
function printSelectedDate(selectedDate) {
    var tableRows = document.querySelectorAll("#css2-body tr");

    // Generate printable/downloadable content with selected date in each row
    var content = "<table><thead><tr><th colspan='6'>Date:" + selectedDate + "</td></tr>";
    tableRows.forEach(function(row) {
        var dateInserted = row.cells[5].textContent; // Assuming Date Inserted is the 6th column
        if (dateInserted === selectedDate) {
            content += "<tr>" + row.innerHTML + "<td>" + selectedDate + "</td></tr>";
        }
    });
    content += "</tbody></table>";

    // Print or initiate download
    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title></head><body>' + content + '</body></html>');
    printWindow.document.close();
    printWindow.print();
}
