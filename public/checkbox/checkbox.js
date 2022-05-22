const checkAll = document.querySelectorAll("[data-checkall-trigger]");
let uncheckedState;
let someCheckedState;
let checkedState;
const allState = document.querySelectorAll(".state");
const inputState = document.querySelectorAll('[data-checkall-group="group1"]');
const allCheckBox = document.querySelectorAll(".child__box-container");

function checkBoxStatus(checkedStatus, el) {
    el.closest(".check__all-design")
        .querySelectorAll(".state")
        .forEach((el) => el.classList.remove("active-state"));
    if (checkedStatus === true) {
        el.closest(".check__all-design")
            .querySelector(".checked")
            .classList.add("active-state");
    }
}

// manipulates the checkboxes states
function checkCondition(childBoxContainer, checkboxParent, checkboxes = 0) {
    if (!checkboxParent) {
        // if no checkboxparent select the parent from the got element
        // here the parent class name should be same as the selected except the chekbox tab
        // childBoxContainer -> represents the element containing all the checkboxes
        checkboxes = childBoxContainer.querySelectorAll(`input`);
        checkboxParent = document.querySelector(
            `.check__box-container-${childBoxContainer.dataset.checkboxTab}`
        );
    }

    someCheckedState = checkboxParent.querySelector(".some__checked");
    checkedState = checkboxParent.querySelector(".checked");

    let checkedCount = 0;
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            //
            checkedCount++;
        }
    }
    let editModeCheckedStatus;

    if (checkedCount === checkboxes.length) {
        //   checkBoxStatus(true);
        checkboxParent
            .querySelectorAll(".state")
            .forEach((el) => el.classList.remove("active-state"));
        checkboxParent.querySelector(".checked").classList.add("active-state");

        editModeCheckedStatus = checkboxParent.querySelector(
            `#checkAll-${checkboxParent.dataset.containerId}`
        );

        editModeCheckedStatus.checked = true;
    } else if (checkedCount < checkboxes.length && checkedCount !== 0) {
        //   someCheckedStatus();

        checkboxParent
            .querySelectorAll(".state")
            .forEach((el) => el.classList.remove("active-state"));
        checkboxParent
            .querySelector(".some__checked")
            .classList.add("active-state");
        // for edit mode
        editModeCheckedStatus = checkboxParent.querySelector(
            `#checkAll-${checkboxParent.dataset.containerId}`
        );

        editModeCheckedStatus.checked = false;
    } else {
        checkedCount = 0;

        checkboxParent
            .querySelectorAll(".state")
            .forEach((el) => el.classList.remove("active-state"));
        //   checkboxParent.querySelector(".s").classList.add("active-state");

        editModeCheckedStatus = checkboxParent.querySelector(
            `#checkAll-${checkboxParent.dataset.containerId}`
        );
        if (editModeCheckedStatus) {
            editModeCheckedStatus.checked = true;
        }

        editModeCheckedStatus.checked = !editModeCheckedStatus.checked;
    }
}

allCheckBox.forEach((el) => {
    // check default checkbox status
    checkCondition(el);

    el.addEventListener("click", function (e) {
        const element = e.target.closest(".child__box-container");
        const checkboxes = element.querySelectorAll(`input`);
        if (!element.dataset.checkboxTab) return;
        const checkboxParent = document.querySelector(
            `.check__box-container-${element.dataset.checkboxTab}`
        );

        // uncheckedState = ;
        checkCondition(_, checkboxParent, checkboxes);
    });
});

function toggleCheckboxGroup(checked, checkboxGroup) {
    let matchingCheckboxes = document.querySelectorAll(
        '[data-checkall-group="' + checkboxGroup + '"]'
    );
    matchingCheckboxes.forEach(function (el) {
        if (checked === true) {
            el.checked = true;
        } else {
            el.checked = false;
        }
    });
    return !checked;
}

checkAll.forEach((el) => {
    el.addEventListener("change", function () {
        let checkboxGroup = el.dataset.checkallTrigger;
        let checked = el.checked ? true : false;
        toggleCheckboxGroup(checked, checkboxGroup);
        checkBoxStatus(checked, el);
    });
});
