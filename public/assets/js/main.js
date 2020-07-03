
// TODO: separate frontend and backend file
window.onload = () => {

    const deleteButton = Array.from(document.getElementsByClassName('delete-button'))
    const approveComment = Array.from(document.getElementsByClassName('approve-comment'))
    const deleteComment = Array.from(document.getElementsByClassName('delete-comment'))

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
