$(function () {
  $("#start").click(function () {
    setTimeout(function () {
      function checkIfComplete() {
        if (Finished == false) {
          Finished = true;
          $("#flag").css("display", "block");
          $("#container-fluid").css("opacity", "0.8");
        } else {
          place = "second";
          $("#startOver").removeAttr("disabled");
        }
      }

      let carWidth = $("#car1").width();

      let trackWidth = $(window).width() - carWidth;

      let raceTime1 = Math.floor(Math.random() * 5500 + 1);
      let raceTime2 = Math.floor(Math.random() * 5500 + 1);

      let Finished = false;

      let place = "first";

      $("#car1").animate(
        {
          left: trackWidth,
        },
        raceTime1,
        function () {
          checkIfComplete();

          $(".lastScore1").append(
            `<tr>
		  <td class="font15 p-2">
			
			Finished in: <span class="big">` +
              place +
              `</span> place with a time of: <span class="big">` +
              raceTime1 +
              `</span> milliseconds!
			
		  </td>
		</tr>`
          );

          $("#p1").css("display", "block");
          localStorage.setItem("place1", place);
          localStorage.setItem("raceTime1", raceTime1);

          $("body").on("click", function () {
            $("#flag").css("display", "none");
            $("#container-fluid").css("opacity", "1");
          });

        }
      );

      $("#car2").animate(
        {
          left: trackWidth,
        },
        raceTime2,
        function () {
          checkIfComplete();

          $(".lastScore2").append(`<tr>
		  <td class="font15 p-2">
			
			Finished in: <span class="red"> ${place} </span> place with a time of: <span class="red"> ${raceTime2} </span> milliseconds!
			
		  </td>
		</tr>`);

          $("#p2").css("display", "block");
          localStorage.setItem("place2", place);
          localStorage.setItem("raceTime2", raceTime2);

          $("body").on("click", function () {
            $("#flag").css("display", "none");
            $("#container-fluid").css("opacity", "1");
          });

        }
      );
    }, 3000);
  });

  $("#startOver").click(function () {
    $(".cars").css("left", "0");
    $("#flag").css("display", "none");
    $("#container-fluid").css("opacity", "1");
    $("#start").removeAttr("disabled");
    isStarted = false;

    $("#p1").css("display", "none");
    $("#p2").css("display", "none");
  });

  isStarted = false;
  $("#start").click(function () {
    $("#start").attr("disabled", "disabled");
    $("#startOver").attr("disabled", "disabled");

    if (isStarted == false) {
      isStarted = true;

      $("#counter3").css("display", "block");
      $("#container-fluid").css("opacity", "0.8");

      setTimeout(function () {
        $("#counter3").css("display", "none");
        $("#counter2").css("display", "block");
      }, 1000);
      setTimeout(function () {
        $("#counter2").css("display", "none");
        $("#counter1").css("display", "block");
      }, 2000);

      setTimeout(function () {
        $("#counter1").css("display", "none");
        $("#container-fluid").css("opacity", "1");
      }, 3000);
      isStarted = true;
    }
  });

  let lastPlace1 = localStorage.getItem("place1");
  let lastRaceTime1 = localStorage.getItem("raceTime1");
  let lastPlace2 = localStorage.getItem("place2");
  let lastRaceTime2 = localStorage.getItem("raceTime2");

  if (lastRaceTime1 == null && lastRaceTime2 == null) {
    $(".previousRezult").hide();
  } else {
    $("#result3 p").html(
      '<span class="big">Car 1</span> finished in <span class="big">' +
        lastPlace1 +
        '</span> place with a time of <span class="big">' +
        lastRaceTime1 +
        "</span> milliseconds!"
    );
    $("#p3").css("display", "block");
    $("#result4 p").html(
      '<span class="red">Car 2</span> finished in <span class="red">' +
        lastPlace2 +
        '</span> place with a time of <span class="red">' +
        lastRaceTime2 +
        "</span> milliseconds!"
    );
    $("#p4").css("display", "block");
  }
});
