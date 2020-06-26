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

    const newComment = {
        form: document.getElementById('comment-form'),
        fail: "un problème et survenu :(",
        success: "Commentaire envoyé, en attente de modération :)",
        method: 'POST',
        url: '/newcomment'
    }

    const login = {
        form: document.getElementById('login'),
        method: 'POST',
        url: '/login'
    }


    doAction(newComment, Ajax.create)
    doAction(login, Ajax.login)
    logoutButton.onclick = (e) => {
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
