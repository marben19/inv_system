security();

async function security() {
  const { value: email, isConfirmed } = await Swal.fire({
    title: "Security key",
    input: "text",
    inputPlaceholder: "Enter security key",
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCancelButton: true, 
    confirmButtonText: 'OK',
    cancelButtonText: 'Cancel'
  });
  
  if (isConfirmed) { 
    if (email && email === "2024") {
      Swal.fire({
        icon: 'success',
        title: 'Unlocked successfully.',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          updateProfile();
        }
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Invalid security key',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "http://localhost/mysystem/admin/?analytics";
        }
      });
    }
  } else {
    window.location.href = "http://localhost/mysystem/admin/?analytics";
  }
}


$(document).on("click", "#update-pass", (e) => {
  $.ajax({
    url: "../api/update-password",
    type: "POST",
    dataType: "json",
    data: {
      userid: e.target.dataset.userid,
      newpassword: $("#newpassword").val()
    },
    beforeSend: (e) => {
      Swal.fire({
        html: 'Loading...',
        didOpen: () => {
          Swal.showLoading()
        }
      })
    },
    success: (data) => {
      Swal.close();
      Swal.fire({
        icon: 'success',
        title: 'Updated successfully.',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      })
    }
  });
});
