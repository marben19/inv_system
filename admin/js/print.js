$.ajax({
  url: "../api/lists-locations",
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

    $("#locations").empty().append(`
      <option value="" hidden selected>Select Location</option>
    `);
    $.each(data.locations, (i, e) => {
        $("#locations").append(`
          <option value="${e.location}">${e.location}</option>
          `);
    })

  },
});

$(document).on("change", "#locations", (e)=>{

$.ajax({
  url: "../api/lists-transfered-products",
  type: "GET",
  dataType: "json",
  data: {
    location: $("#locations").val()
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

    $("#css2-body").empty();

    $.each(data.transfered, (i, e) => {
      $("#css2-body").append(`
        <tr>
          <td>${e.id}</td>
          <td>${e.product}</td>
          <td>${e.description}</td>
          <td>${e.location}</td>
          <td>${e.date_inserted}</td>
          <td>${e.amount}</td>
          <td>
            <button class="btn btn-primary print"
              data-name="${e.product}"
              data-id="${e.id}"
              data-qty="${e.quantity}"
              data-desc="${e.description}"
              data-date="${e.date_inserted}"
              data-amount="${e.amount}"
              data-serial="${e.serial_no}"
              data-location="${e.location}"
              >
              Print
            </button>

          </td>
        </tr>
      `);
    });

    $(".dataTable").DataTable();
  },
});


});


$(document).on("click", ".print", (e)=>{

  $("#print-modal").modal("show");

  $("#description").empty().append(`
    <b style="color: blue;">Description: </b> ${e.target.dataset.desc}
  `);
  $("#serialno").empty().append(`
    <b style="color: blue;">Serial #: </b> ${e.target.dataset.serial}
  `);
  $("#issue").empty().append(`
    <b style="color: blue;">Issued Date: </b> ${e.target.dataset.date}
  `);
  $("#amount").empty().append(`
    <b style="color: blue;">Amount: </b> ${e.target.dataset.amount}
  `);
  $("#invent").empty().append(`
    <b style="color: blue;">Inventory No.: </b> ${e.target.dataset.id}
  `);

  $("#location").empty().append(`
    <b style="color: blue;">Location: </b> ${e.target.dataset.location}
  `);
})

