import Ajax from './ajax'
// TODO: separate frontend and backend file
window.onload = () => {

    const doAction = function (data, callback) {
        if (data.form) {
            data.form.onsubmit = ev => {
                ev.preventDefault()
                callback(data)
            }
        }
    }

    const validateField = function (value) {
        Ajax.validate(value)
    }


    const newPost = {
        form: document.getElementById('create-post-form'),
        fail: "un problème et survenu",
        success: "Succés",
        method: 'POST',
        url: '/newpost'
    }

    const newComment = {
        form: document.getElementById('comment-form'),
        fail: "un problème et survenu :(",
        success: "Commentaire envoyé, en attente de modération :)",
        method: 'POST',
        url: '/newcomment'
    }

    const updatePost = {
        form: document.getElementById('update-post-form'),
        fail: "un problème et survenu :(",
        success: "Article Mis à jour",
        method: 'POST',
        url: '/updatepost'
    }

    const register = {
        form: document.getElementById('register'),
        fail: 'erreur',
        success: 'Compte créé !',
        method: 'POST',
        url: '/register'
    }

    doAction(newPost, Ajax.create)
    doAction(newComment, Ajax.create)
    doAction(updatePost, Ajax.update)
    doAction(register, Ajax.create)

    const deleteButton = Array.from(document.getElementsByClassName('delete-button'))
    const approveComment = Array.from(document.getElementsByClassName('approve-comment'))
    const deleteComment = Array.from(document.getElementsByClassName('delete-comment'))
    const userNameField = document.getElementById('username')

    console.log(userNameField)

    function test(e) {
        validateField(e.target.value)
    }

    userNameField.addEventListener('change', test)

    deleteButton.map(e => {
        e.onclick = () => confirm('Voulez-vous supprimer ce post ainsi que tout ses commentaires? cette opération est irréversible')
    })
    approveComment.map(e => {
        e.onclick = () => confirm('Voulez-vous approuver ce commentaire?')
    })
    deleteComment.map(e => {
        e.onclick = () => confirm('Voulez-vous supprimer ce commentaire?')
    })


}
