const Ajax = {
    create: function (data) {
        const httpRequest = new XMLHttpRequest()
        const formData = new FormData(data.form)

        httpRequest.onerror = () => {
            alert(data.fail)
        }
        httpRequest.onload = () => {
            alert(data.success)
            data.form.reset()
        }

        httpRequest.open(data.method, data.url)
        httpRequest.send(formData)
    },
    delete: function () {
        alert('TODO: Create delete function')
    }
}

export default Ajax