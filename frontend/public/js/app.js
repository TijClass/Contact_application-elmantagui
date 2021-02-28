const addContactBtn = document.querySelector("#addcontact-btn");
const modal = document.querySelector("#modal-container");

addContactBtn.addEventListener("click", () => {
  modal.classList.add("show-modal");
});
modal.addEventListener("click", function (e) {
  if (e.target != this) return;
  console.log("modal clicked");
  modal.classList.remove("show-modal");
});
