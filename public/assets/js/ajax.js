const httpRequest = new XMLHttpRequest()
const Ajax = {
    create: function (data) {
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
    update: function (data) {
        const formData = new FormData(data.form)

        httpRequest.onerror = () => {
            alert(data.fail)
        }
        httpRequest.onload = () => {
            alert(data.success)
            location.reload();
        }
        httpRequest.open(data.method, data.url)
        httpRequest.send(formData)
    },
    validate: function (fieldValue) {
        httpRequest.open('post', '/usernameexist', false)
        httpRequest.send('username=' + fieldValue)
        console.log(httpRequest)
        httpRequest.onload = () => {
            document.getElementById('validate-user').innerHTML = httpRequest.responseText
        }


    }
}

export default Ajax