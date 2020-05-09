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

    doAction(newPost, Ajax.create)
    doAction(newComment, Ajax.create)
    doAction(updatePost, Ajax.update)

}
