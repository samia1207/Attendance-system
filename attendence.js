document.addEventListener("DOMContentLoaded", () => {

  const savedState = JSON.parse(localStorage.getItem("attendanceState")) || {};

//restore saved state
  document.querySelectorAll("#attendanceTable tbody tr").forEach(row => {
    const id = row.children[0].textContent.trim();
    const boxes = row.querySelectorAll("input[type='checkbox']");

    if (savedState[id]) {
      savedState[id].forEach((checked, i) => {
        if (boxes[i]) boxes[i].checked = checked;
      });
    }
  });

  updateAbsences();
});

//auto save attendance state on change
document.getElementById("attendanceTable").addEventListener("change", (e) => {

  if (e.target.type === "checkbox") {

    const state = {};

    document.querySelectorAll("#attendanceTable tbody tr").forEach(row => {
      const id = row.children[0].textContent.trim();
      const boxes = [...row.querySelectorAll("input[type='checkbox']")].map(b => b.checked);
      state[id] = boxes;
    });

    localStorage.setItem("attendanceState", JSON.stringify(state));
    updateAbsences();
  }
});


//colors and counting absences
function updateAbsences() {

  document.querySelectorAll("#attendanceTable tbody tr").forEach(row => {

    const boxes = row.querySelectorAll("input[type='checkbox']");
    let abs = 0;

    for (let i = 0; i < boxes.length; i += 2) {
      if (!boxes[i].checked) abs++;
    }

    row.querySelector("td:last-child").textContent = abs;

    if (abs > 4) row.style.backgroundColor = "#ffb3b3";
    else if (abs === 4) row.style.backgroundColor = "#fff6b3";
    else row.style.backgroundColor = "#c9f5c9";
  });
}

//highlight excellent
$("#highlightExcellent").click(function () {
  $("#attendanceTable tbody tr").each(function () {
    let abs = parseInt($(this).find("td:last").text());

    if (abs < 3) {
      $(this)
        .animate({ opacity: 0.5 }, 300)
        .animate({ opacity: 1 }, 300)
        .css("background-color", "lightgreen");
    }
  });
});


// live search by name
$("#searchName").on("keyup", function () {
  const value = $(this).val().toLowerCase();

  $("#attendanceTable tbody tr").each(function () {
    const name = $(this).find("td:eq(1)").text().toLowerCase(); // Last Name
    const firstName = $(this).find("td:eq(2)").text().toLowerCase(); // First Name

    if (name.includes(value) || firstName.includes(value)) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
});


//  reset colors
$("#resetColors").click(function () {
  $("#attendanceTable tbody tr").css({
    "background-color": "",
    "opacity": "1"
  });
});

// sort by Absences
$("#sortAbsences").click(function () {
  let rows = $("#attendanceTable tbody tr").get();

  rows.sort(function (a, b) {
    let A = parseInt($(a).find("td:last").text());
    let B = parseInt($(b).find("td:last").text());

    if (isNaN(A)) A = 0;
    if (isNaN(B)) B = 0;

    return A - B;
  });

  $("#attendanceTable tbody").empty().append(rows);
});
