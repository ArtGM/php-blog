import Ajax from "./ajax";
// TODO: separate frontend and backend file
window.onload = () => {

    const deleteButton = Array.from(document.getElementsByClassName('delete-button'))
    const approveComment = Array.from(document.getElementsByClassName('approve-comment'))
    const deleteComment = Array.from(document.getElementsByClassName('delete-comment'))
    const userNameField = document.getElementById('username')
    const logoutButton = document.getElementById('logout')
    /**
     * Do action with form data
     * @param data form object
     * @param callback Ajax function
     */
    const doAction = function (data, callback) {
        if (data.form) {
            data.form.onsubmit = ev => {
                ev.preventDefault()
                callback(data)
            }
        }
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
        method: 'POST',
        url: '/register'
    }
    const login = {
        form: document.getElementById('login'),
        method: 'POST',
        url: '/login'
    }


    doAction(newPost, Ajax.create)
    doAction(newComment, Ajax.create)
    doAction(updatePost, Ajax.update)
    doAction(register, Ajax.register)
    doAction(login, Ajax.login)
    logoutButton.onclick = (e) => {
        console.log(e)
        Ajax.logout()
    }

    // TODO : validation on type
    /*
    const check = (e) => {
        validateField(e.target.value)
    }
    const validateField = (value) => {
        Ajax.validate(value)
    }

    userNameField.addEventListener('change', check) */

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
