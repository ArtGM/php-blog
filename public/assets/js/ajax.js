const Ajax = {
    'add': function (data) {
        const httpRequest = new XMLHttpRequest()
        const formData = new FormData(data.form)

        httpRequest.onerror = ev => {
            alert(data.fail)
        }
        httpRequest.onload = ev => {
            alert(data.success)
        }

        httpRequest.open(data.method, data.url)
        httpRequest.send(formData)
    }
}

export default Ajax