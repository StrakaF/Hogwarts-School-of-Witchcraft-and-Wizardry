// CONSTANTS

// Input for filtering and searching
const input = document.querySelector(".filter-input");

// One student (NodeList)
const allOneStudents = document.querySelectorAll(".one-student");

// One student converted to array
const allOneStudentsArray = Array.from(allOneStudents);

// Div with all students on page
const allStudentsDiv = document.querySelector(".all-students");

// Students to object
const studentsObjects = allOneStudentsArray.map( (oneStudent, index) => {
    return {
        id: index,
        studentsName: oneStudent.querySelector("h2").textContent,
        studentsLink: oneStudent.querySelector("a")
    }
});

input.addEventListener("input", () => {
    const inputText = input.value.toLowerCase();
    
    const filteredStudents = studentsObjects.filter( (oneStudent) => {
        return oneStudent.studentsName.toLowerCase().includes(inputText);
    })

    allStudentsDiv.textContent = "";
})