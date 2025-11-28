document.getElementById("addStudentForm").addEventListener("submit", function(e){
  e.preventDefault();

  // input values
  const id = document.getElementById("studentId").value.trim();
  const last = document.getElementById("lastName").value.trim();
  const first = document.getElementById("firstName").value.trim();
  const mail = document.getElementById("email").value.trim();

  let valid = true;

  // clear previous errors
  document.querySelectorAll(".error").forEach(e => e.textContent = "");

  if(id==="" || !/^[0-9]+$/.test(id)){
    document.getElementById("idError").textContent="Please enter a numeric ID."; valid=false;
  }
  if(last==="" || !/^[A-Za-z]+$/.test(last)){
    document.getElementById("lastError").textContent="Letters only."; valid=false;
  }
  if(first==="" || !/^[A-Za-z]+$/.test(first)){
    document.getElementById("firstError").textContent="Letters only."; valid=false;
  }
  if(!/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,}$/.test(mail)){
    document.getElementById("emailError").textContent="Invalid email."; valid=false;
  }
  if(!valid) return;

  //  popup
  alert("✅ Student added successfully!");

  //  save student in localStorage
  let students = JSON.parse(localStorage.getItem("students")) || [];
  students.push({id, last, first, mail});
  localStorage.setItem("students", JSON.stringify(students));

  //  redirect to attendance page
  window.location.href = "attendence.html";
});
