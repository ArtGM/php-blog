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
    }
}

export default Ajax