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

    // Hide every student when start writing to input 
    allStudentsDiv.textContent = "";

    filteredStudents.map( (oneFilteredStudent) => {
        // Created div element with class one-student
        const newDiv = document.createElement("div");
        newDiv.classList.add("one-student");

        // Created h2 with name of filtered student, appended to div
        const newH2 = document.createElement("h2");
        newH2.textContent = oneFilteredStudent.studentsName;
        newDiv.append(newH2);

        // Appended "a" tag to div
        newDiv.append(oneFilteredStudent.studentsLink);

        // Completed div added to container for all students 
        allStudentsDiv.append(newDiv);
    })
})