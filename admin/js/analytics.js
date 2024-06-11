$.ajax({
    url:"../api/analytics",
    type: "GET",
    dataType: "json",
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

    $(".css1").text(data.css1);
    $(".css2").text(data.css2);
    $(".tvet").text(data.tvet);
    $(".animation").text(data.animation);
    $(".vgd").text(data.vgd);


    if (data.css1percent > 45 && data.css1percent < 70) {
        //orange
        $("#card1").attr("style", "background-color: #fca465;");
    }else if(data.css1percent == 0) {
        //red
        $("#card1").attr("style", "background-color: #f73434;");
    }else if(data.css1percent >= 71) {
        //green
        $("#card1").attr("style", "background-color: #65fc6d;");
    }else if(data.css1percent < 45) {
        //red
        $("#card1").attr("style", "background-color: #f73434;");
    }

    if (data.css2percent > 45 && data.css2percent < 70) {
        //orange
        $("#card2").attr("style", "background-color: #fca465;");
    }else if(data.css2percent == 0) {
        //red
        $("#card2").attr("style", "background-color: #f73434;");
    }else if(data.css2percent >= 71) {
        //green
        $("#card2").attr("style", "background-color: #65fc6d;");
    }else if(data.css2percent < 45) {
        //red
        $("#card2").attr("style", "background-color: #f73434;");
    }

    if (data.tvetpercent > 45 && data.tvetpercent < 70) {
        //orange
        $("#card3").attr("style", "background-color: #fca465;");
    }else if(data.tvetpercent == 0) {
        //red
        $("#card3").attr("style", "background-color: #f73434;");
    }else if(data.tvetpercent >= 71) {
        //green
        $("#card3").attr("style", "background-color: #65fc6d;");
    }else if(data.tvetpercent < 45) {
        //red
        $("#card3").attr("style", "background-color: #f73434;");
    }

    if (data.animationpercent > 45 && data.animationpercent < 70) {
        //orange
        $("#card4").attr("style", "background-color: #fca465;");
    }else if(data.animationpercent == 0) {
        //red
        $("#card4").attr("style", "background-color: #f73434;");
    }else if(data.animationpercent >= 71) {
        //green
        $("#card4").attr("style", "background-color: #65fc6d;");
    }else if(data.animationpercent < 45) {
        //red
        $("#card4").attr("style", "background-color: #f73434;");
    }


    if (data.vgdpercent > 45 && data.vgdpercent < 70) {
        //orange
        $("#card5").attr("style", "background-color: #fca465;");
    }else if(data.vgdpercent == 0) {
        //red
        $("#card5").attr("style", "background-color: #f73434;");
    }else if(data.vgdpercent >= 71) {
        //green
        $("#card5").attr("style", "background-color: #65fc6d;");
    }else if(data.vgdpercent < 45) {
        //red
        $("#card5").attr("style", "background-color: #f73434;");
    }



    $(".purchase").text(data.all);

    $(".products").text(data.products);

  }

});