// call on every size change
function mobileNavigation() {
    // console.log("only mobile");

    const hoverElementContainer = document.querySelector(".nav-links");

    hoverElementContainer.addEventListener("click", function (e) {
        // grab only the down arrow
        const clickedElement = e.target.closest(".nav-link");

        if (!clickedElement) return;
        // grab the dropdown
        const grabBlockToShow = clickedElement.querySelector(".dropdown");

        // check if there are more nested dropdowns or not
        const nestedDropdown = grabBlockToShow.querySelector(
            ".dropdown-link .dropdown"
        );

        if (!nestedDropdown) {
            // if no nested simpley toggle the class
            grabBlockToShow.classList.toggle("active");
            return;
        }

        // if there is nested then add active class on the dropdown
        // grabBlockToShow.classList.add("active");

        // look for the nested element to get clicked
        const nestedDropdownParent = e.target.closest(".dropdown-link");

        // if does not find the nested parent block change the active class and then return
        if (!nestedDropdownParent) {
            grabBlockToShow.classList.toggle("active");
            return;
        }
        const nestedDropdownBlock =
            nestedDropdownParent.querySelector(".nested");

        if (!nestedDropdownBlock) return;

        nestedDropdownBlock.classList.toggle("active");

        console.log(e.target);

        console.log(clickedElement, nestedDropdown, nestedDropdownBlock);
    });
}
mobileNavigation();

// checkbox
const hamgurger = document.querySelector("#check");

hamgurger.addEventListener("click", function (e) {
    if (hamgurger.checked === true) {
        document
            .querySelector(".sub-header__container")
            .classList.add("fixed-p", "default-width");

        document.querySelector(".searchIcon").classList.add("fixed-p");

        // scroll
        document.querySelector(".nav-btn").classList.add("fixed-nav-height");

        const mainSection = document.querySelector(".catch");
        if (!mainSection) {
            return;
        }
        mainSection.classList.add("catch-try");
    } else {
        document
            .querySelector(".sub-header__container")
            .classList.remove("fixed-p", "default-width");

        document.querySelector(".searchIcon").classList.remove("fixed-p");
        const mainSection = document.querySelector(".catch");
        if (!mainSection) {
            return;
        }
        mainSection.classList.remove("catch-try");
    }
});

// window.addEventListener("click", function () {
//     mobileNavigation();
// });
