const showInput = ( event) => {
    const span = event.target
    const input = document.getElementById(span.getAttribute('data-input'))
    input.style.display = 'block'
    span.style.display = 'none'
}
const saveData = ( event) => {
    const input = event.target
    const span = document.getElementById('span' + input.id)
    span.innerHTML = input.value
    updateData(input.id, input.value)
    input.style.display = 'none'
    span.style.display = 'block'
}
//Pseudo
spanpseudo.addEventListener('click', showInput )
pseudo.addEventListener('blur', saveData)
//Mail
spanmail.addEventListener('click', showInput )
mail.addEventListener('blur', saveData)

//Avatar
saveAvatar.addEventListener('click', () => {
const avatar = document.getElementById('avatar')
updateData('avatar' , avatar.files[0].name, true)
})

//AJAX
const updateData = (key,value,isFile = false) => {
    const form = new FormData()
    if(isFile){
        file = new File([value], value, {type: 'image/png'})
        form.append(key,file)
    }else{
        form.append(key,value)
    }
  
    const xhr = new XMLHttpRequest()
    xhr.open('POST', 'http://livep1connexion/controllers/udpateUserInfoCtrl.php')
    xhr.send(form)
}
   