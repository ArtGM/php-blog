import Ajax from './ajax'
// TODO: separate frontend and backend file
window.onload = () => {

    const newPost = {
        form: document.getElementById('post-form'),
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

    if (newComment.form) {
        newComment.form.onsubmit = ev => {
            ev.preventDefault()
            Ajax.create(newComment)
        }
    }

    if (newPost.form) {
        newPost.form.onsubmit = ev => {
            ev.preventDefault()
            Ajax.create(newPost)
        }
    }
}
