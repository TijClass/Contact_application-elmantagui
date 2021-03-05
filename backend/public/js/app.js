const addContactBtn = document.querySelector("#addcontact-btn");
const modal = document.querySelector("#modal-container");
const modalBtn = document.querySelector("#modal-btn");
const editActionButtons = document.querySelectorAll(".edit-action");
const closeIcons = document.querySelectorAll(".close-icon");
const operations = { add: "add", edit: "edit" };
Object.freeze(operations);

addContactBtn.addEventListener("click", () => {
  prepareModal(operations.add);
  showModal(modal)
});
function showModal(modal){
  modal.classList.add("show-modal");
}
function hideModal(modal){
  modal.classList.remove("show-modal");
}
function editHandler(e){
    const trParent = e.target.parentElement.parentElement;
    const tds = trParent.children;
    const data = {id:tds[0].textContent,firstName:tds[1].textContent,lastName:tds[2].textContent,email:tds[3].textContent,adress:tds[4].textContent,phone:tds[5].textContent,groupe:tds[6].textContent};
    prepareModal(operations.edit,data);
    showModal(modal)
  }
editActionButtons.forEach((el)=>{
  el.addEventListener('click',editHandler);
});
function deleteHandler(e){
    const trParent = e.target.parentElement.parentElement.parentElement;
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this contact!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        //successed
        const {id} = e.target.dataset;
        axios.post('/delete_contact', {id})
        .then((res)=>{
          console.log("then executed",res);          
          if(res.status == 200){
            // delete from html table
            // trParent.animate([
            //   // keyframes
            //   { scaleX: 1 },             
            //   { scaleX: .8 },             
            //   { scaleX: .6 },             
            //   { scaleX: .5 },             
            //   { scaleX: .4 },             
            //   { scaleX: .3 },             
            //   { scaleX: .2 },             
            //   { scaleX: .15 },             
            //   { scaleX: .1 },             
            //   { scaleX: .05 },             
            //   { scaleX: 0 },             
            // ], {
            //   // timing options
            //   duration: 500,  
            // });
            trParent.remove();
            
          }
        })
        .catch(()=>{
          console.log("catch executed");
        })        
      }
    });
  }
closeIcons.forEach((el)=>{
  el.addEventListener('click',deleteHandler)
});
modal.addEventListener("click", function (e) {
  if (e.target != this) return;
  console.log("modal clicked");
  hideModal(modal);
  modal.dataset.operation = "";
});

function prepareModal(operation, data) {
  if (operation == operations.add) {
    modal.querySelectorAll("input").forEach(e=>e.value="");
    modal.querySelector("#groupe-familly").checked = true;
    modalBtn.innerText = operations.add.toUpperCase();
    modal.dataset.operation = operations.add;
  } else if (operation == operations.edit) {
    modal.querySelector('input[name="id"]').value = data.id;
    modal.querySelector('input[name="firstName"]').value = data.firstName;
    modal.querySelector('input[name="lastName"]').value = data.lastName;
    modal.querySelector('input[name="email"]').value = data.email;
    modal.querySelector('input[name="phone"]').value = data.phone;
    modal.querySelector('input[name="adress"]').value = data.adress;
    modal.querySelector(`#groupe-${data.groupe.toLowerCase()}`).checked = true;
    modalBtn.innerText = operations.edit.toUpperCase();
    modal.dataset.operation = operations.edit;
  }
}
modalBtn.addEventListener('click',(e)=>{
  if(modal.dataset.operation == operations.add){
    // add
    addContact();
  }else if(modal.dataset.operation == operations.edit){
    //edit
    updateContact()
  }
});
function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min) + min); //The maximum is exclusive and the minimum is inclusive
}
function isEmpty(str){
  if(str == ""){
    return true;
  }
  return false;
}
function addContact(){
    const selectedGroupeLabel = modal.querySelector('input[name="groupe"]:checked + label');
    const id = getRandomInt(100,100000);
    const firstName = modal.querySelector('input[name="firstName"]').value;
    const lastName = modal.querySelector('input[name="lastName"]').value;
    const email = modal.querySelector('input[name="email"]').value;
    const phone = modal.querySelector('input[name="phone"]').value;
    const adress = modal.querySelector('input[name="adress"]').value;
    const groupe = selectedGroupeLabel.textContent.trim().toLowerCase();
    if(isEmpty(firstName) || isEmpty(lastName) || isEmpty(email) || isEmpty(phone) || isEmpty(adress) || isEmpty(groupe)){
      swal("Oops...", "Inputs are not valide", "error");
    }
    axios.post('/add_contact', {id,firstName,lastName,email,phone,adress,groupe})
      .then((res)=>{
        console.log("then executed",res);          
        if(res.status == 200){
          hideModal(modal);
          appendContact({id,firstName,lastName,email,phone,adress,groupe});
      }
    });
}
function updateContact(){
    const selectedGroupeLabel = modal.querySelector('input[name="groupe"]:checked + label');
    const id = modal.querySelector('input[name="id"]').value;
    const firstName = modal.querySelector('input[name="firstName"]').value;
    const lastName = modal.querySelector('input[name="lastName"]').value;
    const email = modal.querySelector('input[name="email"]').value;
    const phone = modal.querySelector('input[name="phone"]').value;
    const adress = modal.querySelector('input[name="adress"]').value;
    const groupe = selectedGroupeLabel.textContent.trim().toLowerCase();
    if(isEmpty(firstName) || isEmpty(lastName) || isEmpty(email) || isEmpty(phone) || isEmpty(adress) || isEmpty(groupe)){
      swal("Oops...", "Inputs are not valide", "error");
    }
    axios.post('/edit_contact', {id,firstName,lastName,email,phone,adress,groupe})
      .then((res)=>{
        console.log("then executed",res);          
        if(res.status == 200){
          hideModal(modal);
          editContact({id,firstName,lastName,email,phone,adress,groupe});
      }
    });
}

function appendContact(data){
  const {id,firstName,lastName,email,phone,adress,groupe} = data;
  const tbody = document.querySelector(".contact-table tbody")
  const newTR = document.createElement("tr");
  const idTD = document.createElement("td");
  const firstNameTD = document.createElement("td");
  const lastNameTD = document.createElement("td");
  const emailTD = document.createElement("td");
  const adressTD = document.createElement("td");
  const phoneTD = document.createElement("td");
  const groupeTD = document.createElement("td");
  const actionTD = document.createElement("td");
  const editSpan = document.createElement("span");
  const deleteSpan = document.createElement("span");
  const deleteImg = document.createElement("img");
  editSpan.addEventListener('click',editHandler);
  deleteImg.addEventListener('click',deleteHandler);
  newTR.append(idTD,firstNameTD,lastNameTD,emailTD,adressTD,phoneTD,groupeTD,actionTD);
  idTD.innerText = id;
  firstNameTD.innerText = firstName;
  lastNameTD.innerText = lastName;
  emailTD.innerText = email;
  adressTD.innerText = adress;
  phoneTD.innerText = phone;
  groupeTD.innerText = groupe;
  // <td class="action-td"><span class="edit-action">Edit</span> <span><img data-id="<?=$contact["id"]?>" class="close-icon" src="public/img/x.png" alt=""></span></td>
  actionTD.classList.add("action-td");
  actionTD.append(editSpan,deleteSpan);
  editSpan.classList.add("edit-action");
  editSpan.innerHTML = "Edit";  
  deleteSpan.append(deleteImg);
  deleteImg.dataset.id = id;
  deleteImg.classList.add("close-icon");
  deleteImg.src = "public/img/x.png";
  tbody.append(newTR);
}
function editContact(data){
  const {id,firstName,lastName,email,phone,adress,groupe} = data;
  const curentTr = document.querySelector(`#tr-${id}`);  
  curentTr.children[1].innerText = firstName
  curentTr.children[2].innerText = lastName
  curentTr.children[3].innerText = email  
  curentTr.children[4].innerText = adress
  curentTr.children[5].innerText = phone
  curentTr.children[6].innerText = groupe      
}