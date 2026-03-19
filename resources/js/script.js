console.log("Welcome to the School Examination Management System (SEMS)!");

function setMessage(messageEl, type, text) {
  messageEl.textContent = text || "";
  messageEl.classList.remove("error", "success");
  if (type) messageEl.classList.add(type);
}

function isFilled(controlEl) {
  return controlEl.value.trim() !== "";
}

function setControlState(controlEl, ok) {
  controlEl.classList.toggle("is-invalid", !ok);
  controlEl.classList.toggle("is-valid", ok);
}

function clearControlState(controlEl) {
  controlEl.classList.remove("is-invalid", "is-valid");
}

function wireLiveRequired(controlEl) {
  const handler = () => {
    if (!controlEl.classList.contains("is-invalid") && !controlEl.classList.contains("is-valid")) return;
    setControlState(controlEl, isFilled(controlEl));
  };

  controlEl.addEventListener("input", handler);
  controlEl.addEventListener("change", handler);
}

function flashRow(rowEl) {
  rowEl.classList.add("row-added");
  setTimeout(() => rowEl.classList.remove("row-added"), 800);
}

// CLASS FORM
const classForm = document.getElementById("classForm");
const classMessage = document.getElementById("classMessage");
const classNameEl = document.getElementById("className");
const streamEl = document.getElementById("stream");

wireLiveRequired(classNameEl);
wireLiveRequired(streamEl);

classForm.addEventListener("submit", function(e) {
    e.preventDefault();
    
    // get values from inputs
    const className = classNameEl.value.trim();
    const stream = streamEl.value.trim();

    //  validation to prevent empty space
    const classOk = className !== "";
    const streamOk = stream !== "";
    setControlState(classNameEl, classOk);
    setControlState(streamEl, streamOk);

    if(!classOk || !streamOk) {
         setMessage(classMessage, "error", "Error: Fill all fields!");
    }  
    else 
    {
         setMessage(classMessage, "success", "Success: class of " + className + " " + stream + " is registered successfully!");
         // Add the new class to the table

    const classTbody = document.getElementById("classTbody");
    const newRow = document.createElement("tr");

    newRow.innerHTML = `
          <td>${className} </td>
           <td>${stream} </td>
           `;

    classTbody.appendChild(newRow);
    flashRow(newRow);
      classForm.reset();
      clearControlState(classNameEl);
      clearControlState(streamEl);
    }
});


// SBJECT FORM 
const subForm = document.getElementById("subForm");
const subMessage = document.getElementById("subMessage");
const subTbody = document.getElementById("subTbody");
const subjectEl = document.getElementById("subject");

wireLiveRequired(subjectEl);

subForm.addEventListener("submit", function(e) {
    e.preventDefault();

    const subject = subjectEl.value;

    if(subject === "") {
        setControlState(subjectEl, false);
        setMessage(subMessage, "error", "Error: Please select a subject.");
    }
    else
    {
        setControlState(subjectEl, true);

        // split subject by course code and name
        const dataParts = subject.split("|");
        const subName = dataParts[0];
        const subCode = dataParts[1];

        setMessage(subMessage, "success", "Success: " + subName + " (" + subCode + ") registered.");


        const newRow = document.createElement("tr");
        newRow.innerHTML = `
        <td>${subCode}</td>
        <td>${subName}</td>
        `;

        subTbody.appendChild(newRow);
        flashRow(newRow);

        subForm.reset();
        clearControlState(subjectEl);
    }
});

// techerForm

const teacherForm = document.getElementById("teacherForm");
const teaMessage = document.getElementById("teaMessage");
const teaBody = document.getElementById("teaBody");
const teacherNameEl = document.getElementById("teacherName");
const teacherEmailEl = document.getElementById("teacherEmail");
const teacherPhoneEl = document.getElementById("teacherPhone");
const teacherGenderEl = document.getElementById("teacherGender");

wireLiveRequired(teacherNameEl);
wireLiveRequired(teacherEmailEl);
wireLiveRequired(teacherPhoneEl);
wireLiveRequired(teacherGenderEl);

teacherForm.addEventListener("submit", function(e) {
     e.preventDefault();

    const teacherName = teacherNameEl.value.trim();
    const teacherEmail = teacherEmailEl.value.trim();
    const teacherPhone = teacherPhoneEl.value.trim();
    const teacherGender = teacherGenderEl.value.trim();
    
   const nameOk = teacherName !== "";
   const emailOk = teacherEmail !== "";
   const phoneOk = teacherPhone !== "";
   const genderOk = teacherGender !== "";

   setControlState(teacherNameEl, nameOk);
   setControlState(teacherEmailEl, emailOk);
   setControlState(teacherPhoneEl, phoneOk);
   setControlState(teacherGenderEl, genderOk);

   if(!nameOk || !emailOk || !phoneOk || !genderOk){
       setMessage(teaMessage, "error", "Error: Fill all fields.");
   }
   else
   {
    setMessage(teaMessage, "success", "Success: " + teacherName + " registered successfully!");

    const newRow = document.createElement("tr");

    newRow.innerHTML = `
      <td>${teacherName}</td>
      <td>${teacherEmail}</td>
      <td>${teacherPhone}</td>
      <td>${teacherGender}</td>
    `;

    teaBody.appendChild(newRow);
    flashRow(newRow);

    teacherForm.reset();
    clearControlState(teacherNameEl);
    clearControlState(teacherEmailEl);
    clearControlState(teacherPhoneEl);
    clearControlState(teacherGenderEl);
   }

});
