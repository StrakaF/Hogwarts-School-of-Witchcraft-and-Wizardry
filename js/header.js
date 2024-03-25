// Výber HTML tagov s ktorými pracujeme
const menuIcon = document.querySelector(".menu-icon");
const navigation = document.querySelector("nav");
const hamburgerIcon = document.querySelector(".fa-solid");

menuIcon.addEventListener("click", () => {           //po kliknuti
    if (hamburgerIcon.classList[1] === "fa-bars") { //ked je icon hamburger
        hamburgerIcon.classList.remove("fa-bars"); //removni ju
        hamburgerIcon.classList.add("fa-xmark"); //a pridaj X icon
    } else {
        hamburgerIcon.classList.remove("fa-xmark"); //ked je icon X, removni ju
        hamburgerIcon.classList.add("fa-bars");    //a nastav naspat hamburger icon
    }
});