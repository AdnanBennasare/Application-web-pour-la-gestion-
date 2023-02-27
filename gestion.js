

  // add images for anounce
  const imageInput = document.querySelector("#image-input");
  const image = document.querySelector("#images");
  let files_add = [];
  imageInput.addEventListener("change", function(event) {
    const array=Array.from(event.target.files);
    console.log(array);
    for (let i = 0; i < array.length; i++) {
      files_add.push( array[i]);
    }
    for (let i = 0; i < this.files.length; i++) {
      const file=this.files[i];
      if (file) {
        const reader = new FileReader();
        reader.addEventListener("load", function() {
          image.innerHTML+=` 
          <div class="image">
          <img src="${this.result}" alt="Snow" style="width:100%;">
          <div class="bottom-left">  
            <input  type="radio" name="statu" value="${file.name}">
             principal
          </div>
          <a class="top-right" onclick="remove(this)"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
        </div>
          `
        });
        reader.readAsDataURL(file);
        console.log(files_add);
      }
    }
  });
  // // remove image add from files
  function remove(icon) {
    const iconparent=icon.closest(".image");
    const file_input_parent=icon.closest(".formvalid")
    const file_input=file_input_parent.querySelector("input[type='file']");
    const radio_input=file_input_parent.querySelector("input[type='radio']");
    console.log(files_add);
    files_add = files_add.filter((file) => file.name !== radio_input.value);
    console.log(files_add);
     const newFiles = new DataTransfer();
     for (let i = 0; i < files_add.length; i++) 
     {
         newFiles.items.add(files_add[i]);
     }    
     file_input.files = newFiles.files
     console.log(file_input.files);
    iconparent.remove();
  }
  
  // add image in form updat announce
  const images_updat = document.querySelectorAll(".rectangle_updat input[type='file']");
  console.log(images_updat);
  let files_updat=[];
  for (let i = 0; i < images_updat.length; i++) {
    console.log(images_updat[i]);
     const parent_updat=images_updat[i].closest(".formvalid")
     const image_updat=parent_updat.querySelector(".images1")
    images_updat[i].addEventListener("change", function(event){
      const array=Array.from(event.target.files);
      console.log(array);
      for (let i = 0; i < array.length; i++) {
          files_updat.push( array[i]);
      }
        for (let i = 0; i < this.files.length; i++) {
          const file_updat=this.files[i];
          console.log(file_updat);
          if (file_updat) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
              image_updat.innerHTML+=` 
              <div class="image">
              <img src="${this.result}" alt="Snow" style="width:100%;">
              <div class="bottom-left">  
                <input  type="radio" name="statu"  value="${file_updat.name}">
                 principal
              </div>
              <a class="top-right" onclick="remove_updat(this)"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
            </div>
              `
            });
            reader.readAsDataURL(file_updat);
            console.log(files_updat);
          }
        }
  
    });
  }
  function remove_updat(icon) {
    console.log(icon);
    const iconparent=icon.closest(".image");
    const file_input_parent=iconparent.closest(".formvalid")
    const file_input=file_input_parent.querySelector("input[type='file']");
    const radio_input=file_input_parent.querySelector("input[type='radio']");
    console.log(files_updat);
    files_updat = files_updat.filter((file) => file.name != radio_input.value);
    console.log(files_updat);
     const newFiles = new DataTransfer();
     for (let i = 0; i < files_updat.length; i++) 
     {
         newFiles.items.add(files_updat[i]);
     }    
     file_input.files = newFiles.files
     console.log(file_input.files);
    iconparent.remove();
  }
  
  
  
      
  
  
  
  
  
  //show hide password 
  const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#mot_passe');
  
    togglePassword.addEventListener('click', function () {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye');
  });
  // //show hide confirm password 
  const togglePasswordconfirm = document.querySelector('#togglePasswordconfirm');
    const passwordconfirm = document.querySelector('#mot_passe_confirm');
  
    togglePasswordconfirm.addEventListener('click', function () {
  
      // toggle the type attribute
      const type = passwordconfirm.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordconfirm.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye');
  });
  
  
  // // validation form updat announce
  function setErrorFor(element, errorMessage) {
    const parent = element.closest('.formvalid');
    if(parent.classList.contains('formvalid-success')){
        parent.classList.remove('formvalid-success');
    }
    parent.classList.add('formvalid-error');
    const small = parent.querySelector('small');
    small.textContent = errorMessage;
  }
  function setSuccessFor(element){
    const parent = element.closest('.formvalid');
    if(parent.classList.contains('formvalid-error')){
        parent.classList.remove('formvalid-error');
    }
    parent.classList.add('formvalid-success');
    const small = parent.querySelector('small');
    small.textContent = ' ';
  }
  const form = document.querySelector('.myFormupdat');
  const titre = document.querySelector('.titleupdat');
  const prix = document.querySelector(".priceupdat");
  const ville = document.querySelector(".villeupdat");
  const type = document.querySelector(".typeupdat");
  const codepostal = document.querySelector(".codpostalupdat");
  const categorie =document.querySelector('.categorieupdat');
  const description =document.querySelector('.descriptionupdat');
  const file =document.querySelector('.image-input1');
  form.addEventListener('submit', (event)=>{
    validate_Form_updat_announce();
    console.log(isFormValid_updat_announce());
    if(isFormValid_updat_announce()==true){
        form.submit();
     }else {
         event.preventDefault();
     }
  
  });
  
  function isFormValid_updat_announce(){
    const inputContainers = form.querySelectorAll('.formvalid');
    let result = true;
    inputContainers.forEach((container)=>{
        if(container.classList.contains('formvalid-error')){
            result = false;
        }
    });
    return result;
  }
  
  function validate_titre()
  {
      if(titre.value.match(/[a-zA-Z]{3,30}/g)) {
          setSuccessFor(titre);
      } else {
          setErrorFor(titre, 'champ obligatoire');
      }
  }
  function validate_file()
  {
      if(file.value =='' ) {
        setErrorFor(file, 'champ obligatoire');
      } else if(file.files.length>5){
        setErrorFor(file, 'maximun est 5 image');
      }
      else
      {
        setSuccessFor(file);
      }
  }
  function validate_prix()
  {
      if(prix.value > 0) {
          setSuccessFor(prix);
      } else {
          setErrorFor(prix, 'champ obligatoire');
      }
  }
  function validate_ville()
  {
      if(ville.value.match(/[a-zA-Z]{3,30}/g)) {
          setSuccessFor(ville);
      } else {
          setErrorFor(ville, 'champ obligatoire');
      }
  }
  function validate_type()
  {
      if(type.selectedIndex > 0) {
          setSuccessFor(type);
      } else {
          setErrorFor(type, 'champ obligatoire');
      }
  }
  function validate_codepostal()
  {
      if(codepostal.value >0) {
          setSuccessFor(codepostal);
      } else {
          setErrorFor(codepostal, 'champ obligatoire');
      }
  }
  function validate_categorie()
  {
      if(categorie.selectedIndex >0) {
          setSuccessFor(categorie);
      } else {
          setErrorFor(categorie, 'champ obligatoire');
      }
  }
  function validate_description()
  {
      if(description.value.match(/[a-zA-Z]{3,50}/g)) {
          setSuccessFor(description);
      } else {
          setErrorFor(description, 'champ obligatoire');
      }
  }
  function validate_Form_updat_announce()
  {
    validate_titre();
    validate_type();
    validate_prix();
    validate_description();
    validate_codepostal();
    validate_categorie();
    validate_ville();
    // validate_file();
  }
  // // validation form add announce
  const form_add = document.querySelector('#myFormadd');
  const titre_add = document.querySelector('#titleAdd');
  const prix_add = document.querySelector("#priceAdd");
  const ville_add = document.querySelector("#villeadd");
  const type_add = document.querySelector("#typeAdd");
  const codepostal_add = document.querySelector("#codpostal");
  const categorie_add =document.querySelector('#categorieaadd');
  const description_add =document.querySelector('#descriptionadd');
  const file_add =document.querySelector('#image-input');
  form_add.addEventListener('submit', (event)=>{
    validate_Form_add_announce();
    console.log(isFormValid_add_announce());
    if(isFormValid_add_announce()==true){
        form_add.submit();
     }else {
         event.preventDefault();
     }
  
  });
  
  function isFormValid_add_announce(){
    const inputContainers = form_add.querySelectorAll('.formvalid');
    let result = true;
    inputContainers.forEach((container)=>{
        if(container.classList.contains('formvalid-error')){
            result = false;
        }
    });
    return result;
  }
  
  function validate_titre_add()
  {
      if(titre_add.value.match(/[a-zA-Z]{3,30}/g)) {
          setSuccessFor(titre_add);
      } else {
          setErrorFor(titre_add, 'champ obligatoire');
      }
  }
  function validate_file_add()
  {
      if(file_add.value =='' ) {
        setErrorFor(file_add, 'champ obligatoire');
      } else if(file_add.files.length>5){
        setErrorFor(file_add, 'maximun est 5 image');
      }
      else
      {
        setSuccessFor(file_add);
      }
  }
  function validate_prix_add()
  {
      if(prix_add.value > 0) {
          setSuccessFor(prix_add);
      } else {
          setErrorFor(prix_add, 'champ obligatoire');
      }
  }
  function validate_ville_add()
  {
      if(ville_add.value.match(/[a-zA-Z]{3,30}/g)) {
          setSuccessFor(ville_add);
      } else {
          setErrorFor(ville_add, 'champ obligatoire');
      }
  }
  function validate_type_add()
  {
      if(type_add.selectedIndex > 0) {
          setSuccessFor(type_add);
      } else {
          setErrorFor(type_add, 'champ obligatoire');
      }
  }
  function validate_codepostal_add()
  {
      if(codepostal_add.value >0) {
          setSuccessFor(codepostal_add);
      } else {
          setErrorFor(codepostal_add, 'champ obligatoire');
      }
  }
  function validate_categorie_add()
  {
      if(categorie_add.selectedIndex >0) {
          setSuccessFor(categorie_add);
      } else {
          setErrorFor(categorie_add, 'champ obligatoire');
      }
  }
  function validate_description_add()
  {
      if(description_add.value.match(/[a-zA-Z]{3,50}/g)) {
          setSuccessFor(description_add);
      } else {
          setErrorFor(description_add, 'champ obligatoire');
      }
  }
  function validate_Form_add_announce()
  {
    validate_titre_add();
    validate_type_add();
    validate_prix_add();
    validate_description_add();
    validate_codepostal_add();
    validate_categorie_add();
    validate_ville_add();
    validate_file_add();
  }
    // // validation form add announce
    const form_info = document.querySelector('#myFormainfo');
    const nom = document.querySelector('#nom');
    const prenom = document.querySelector("#prenom");
    const adresse = document.querySelector("#email");
    const telephone = document.querySelector("#telephon");
    const motpasse = document.querySelector("#mot_passe");
    const confirmpasse =document.querySelector('#mot_passe_confirm');
 
    form_info.addEventListener('submit', (event)=>{
      validate_Form_info();
      console.log(isFormValid_info());
      if(isFormValid_info()==true){
          form_info.submit();
       }else {
           event.preventDefault();
       }
    
    });
    
    function isFormValid_info(){
      const inputContainers = form_info.querySelectorAll('.formvalid');
      let result = true;
      inputContainers.forEach((container)=>{
          if(container.classList.contains('formvalid-error')){
              result = false;
          }
      });
      return result;
    }
    
    function validate_nom()
    {
        if(nom.value.match(/[a-zA-Z]{3,30}/g)) {
            setSuccessFor(nom);
        } else {
            setErrorFor(nom, 'champ obligatoire');
        }
    }

    function validate_prenom()
    {
        if(prenom.value.match(/[a-zA-Z]{3,30}/g)) {
            setSuccessFor(prenom);
        } else {
            setErrorFor(prenom, 'champ obligatoire');
        }
    }
    function validate_adresse()
    {
        if(adresse.value!="") {
            setSuccessFor(adresse);
        } else {
            setErrorFor(adresse, 'champ obligatoire');
        }
    }
    function validate_motpasse()
    {
        if(motpasse.value!="") {
            setSuccessFor(motpasse);
        } else {
            setErrorFor(motpasse, 'champ obligatoire');
        }
    }
    function validate_confirmmotpasse()
    {
        if(confirmpasse.value!="") {
            setSuccessFor(confirmpasse);
        } else {
            setErrorFor(confirmpasse, 'champ obligatoire');
        }
    }
    function validate_tele()
    {
        if(telephone.value>0) {
            setSuccessFor(telephone);
        } else {
            setErrorFor(telephone, 'champ obligatoire');
        }
    }
    function validate_Form_info()
    {
      validate_nom();
      validate_prenom();
      validate_tele();
      validate_confirmmotpasse();
      validate_motpasse();
      validate_adresse()


    }
  
  