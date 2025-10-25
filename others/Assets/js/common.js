function filePreview(file, photoPreview, defaultPhoto){
    if(file == null){
        photoPreview.src = defaultPhoto;
    }else{
        const reader = new FileReader();
        reader.onload = function(){
            photoPreview.src = reader.result;
        }
        reader.readAsDataURL(file);
    }
}



const themeToggler = document.querySelector(".theme-toggler");

themeToggler.addEventListener('click', () =>{
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('activedark');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('activedark');
})


