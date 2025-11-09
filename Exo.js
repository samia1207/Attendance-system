// Function to update absences and highlight
  function updateAbsences() {
    document.querySelectorAll("#attendanceTable tbody tr").forEach(row => {
      const boxes = row.querySelectorAll("input[type='checkbox']");
      let abs = 0;

      // check presence boxes only (even indexes)
      for (let i = 0; i < boxes.length; i += 2) {
        if (!boxes[i].checked) abs++;
      }

      row.querySelector("td:last-child").textContent = abs;

      // Apply color based on absences
      if (abs > 4) {
        row.style.backgroundColor = "#ffb3b3"; // red
      } else if (abs === 4) {
        row.style.backgroundColor = "#fff6b3"; // yellow
      } else {
        row.style.backgroundColor = "#c9f5c9"; // green
      }
    });
  }

  // Run at start
  updateAbsences();

  // When checkbox changes
  document.querySelector("#attendanceTable").addEventListener("change", e => {
    if (e.target.type === "checkbox") {
      updateAbsences();
    }
  });

  // Add student + validation
document.getElementById("addStudentForm").addEventListener("submit", function(e){
  e.preventDefault();

  // Get input elements first 
  const studentId = document.getElementById("studentId");
  const lastName = document.getElementById("lastName");
  const firstName = document.getElementById("firstName");
  const email = document.getElementById("email");
  const idError = document.getElementById("idError");
  const lastError = document.getElementById("lastError");
  const firstError = document.getElementById("firstError");
  const emailError = document.getElementById("emailError");
  const confirmation = document.getElementById("confirmation");

  let id = studentId.value.trim();
  let last = lastName.value.trim();
  let first = firstName.value.trim();
  let mail = email.value.trim();
  let valid = true;

  // Clear previous errors
  document.querySelectorAll(".error").forEach(e => e.textContent = "");

  if(id==="" || !/^[0-9]+$/.test(id)){
    idError.textContent="Please enter a numeric ID."; valid=false;
  }
  if(last==="" || !/^[A-Za-z]+$/.test(last)){
    lastError.textContent="Letters only."; valid=false;
  }
  if(first==="" || !/^[A-Za-z]+$/.test(first)){
    firstError.textContent="Letters only."; valid=false;
  }
  if(!/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,}$/.test(mail)){
    emailError.textContent="Invalid email."; valid=false;
  }
  if(!valid) return;

  // Add new row
  const tbody = document.querySelector("#attendanceTable tbody");
  const row = document.createElement("tr");
  row.innerHTML = `
    <td>${id}</td><td>${last}</td><td>${first}</td>
    ${Array(8).fill('<td><input type="checkbox"></td>').join("")}
    <td class="center">0</td>
  `;
  tbody.appendChild(row);

  updateAbsences(); // color new row
  confirmation.textContent = "✅ Student added successfully!";
  this.reset();
});


  // Chart
  document.getElementById("showReport").addEventListener("click", ()=>{
    const rows=document.querySelectorAll("#attendanceTable tbody tr");
    let total=rows.length, present=0, participated=0;
    rows.forEach(r=>{
      const boxes=r.querySelectorAll("input[type='checkbox']");
      boxes.forEach((b,i)=>{
        if(i%2==0 && b.checked) present++;
        if(i%2==1 && b.checked) participated++;
      });
    });
    const ctx=document.getElementById("myChart").getContext("2d");
    new Chart(ctx,{
      type:"bar",
      data:{
        labels:["Total","Present","Participated"],
        datasets:[{
          label:"Attendance Report",
          data:[total,present,participated],
          backgroundColor:["#4a6fa5","#28a745","#ffc107"]
        }]
      }
    });
  });

