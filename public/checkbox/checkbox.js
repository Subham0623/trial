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

allCheckBox.forEach((el) => {
  el.addEventListener("click", function (e) {
    const element = e.target.closest(".child__box-container");
    const checkboxes = element.querySelectorAll(`input`);
    if (!element.dataset.checkboxTab) return;
    const checkboxParent = document.querySelector(
      `.check__box-container-${element.dataset.checkboxTab}`
    );
    // uncheckedState = ;
    someCheckedState = checkboxParent.querySelector(".some__checked");
    checkedState = checkboxParent.querySelector(".checked");

    let checkedCount = 0;
    for (let i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        //
        checkedCount++;
      }
    }

    if (checkedCount === checkboxes.length) {
      //   checkBoxStatus(true);

      checkboxParent
        .querySelectorAll(".state")
        .forEach((el) => el.classList.remove("active-state"));
      checkboxParent.querySelector(".checked").classList.add("active-state");
    } else if (checkedCount < checkboxes.length && checkedCount !== 0) {
      //   someCheckedStatus();

      checkboxParent
        .querySelectorAll(".state")
        .forEach((el) => el.classList.remove("active-state"));
      checkboxParent
        .querySelector(".some__checked")
        .classList.add("active-state");
    } else {
      checkedCount = 0;

      checkboxParent
        .querySelectorAll(".state")
        .forEach((el) => el.classList.remove("active-state"));
      //   checkboxParent.querySelector(".s").classList.add("active-state");
    }
  });
});

function toggleCheckboxGroup(checked, checkboxGroup) {
  let matchingCheckboxes = document.querySelectorAll(
    '[data-checkall-group="' + checkboxGroup + '"]'
  );
  matchingCheckboxes.forEach(function (el) {
    if (checked !== el.checked) {
      el.checked = !el.checked;
    }
  });
}

checkAll.forEach((el) => {
  el.addEventListener("change", function () {
    let checkboxGroup = el.dataset.checkallTrigger;
    let checked = el.checked ? true : false;
    toggleCheckboxGroup(checked, checkboxGroup);
    checkBoxStatus(checked, el);
  });
});
