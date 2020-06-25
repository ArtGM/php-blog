import $ from 'jquery'
import 'bootstrap'

const httpRequest = new XMLHttpRequest()
const notifications = document.getElementById('notifications')
const notif = $('#notif')

const Ajax = {
    create(data) {
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
    update(data) {
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
    validate(fieldValue) {
        httpRequest.open('GET', '/usernameexist')
        httpRequest.send(null)
        console.log(httpRequest)
        httpRequest.onload = () => {
            if (httpRequest.status === 200 && httpRequest.readyState === 4) {
                document.getElementById('validate-user').innerHTML = httpRequest.response
            }
        }
    },
    register(data) {
        const formData = new FormData(data.form)
        const registerModal = $('#registerModal')
        httpRequest.onerror = () => {
            alert(data.fail)
        }
        httpRequest.onload = () => {
            if (httpRequest.status === 200 && httpRequest.readyState === 4) {
                notifications.innerHTML = httpRequest.response
                registerModal.modal('toggle')
                notif.modal('show')
            }
            data.form.reset()
        }

        httpRequest.open(data.method, data.url)
        httpRequest.send(formData)
    },
    login(data) {
        const formData = new FormData(data.form)
        const loginModal = $('#loginModal')
        httpRequest.onload = () => {
            if (httpRequest.status === 200 && httpRequest.readyState === 4) {
                notifications.innerHTML = httpRequest.response
                loginModal.modal('toggle')
                notif.modal('show')
                document.location.reload(true)
            }
        }
        httpRequest.open(data.method, data.url)
        httpRequest.send(formData)

    },
    logout() {
        httpRequest.open('GET', '/logout')
        httpRequest.send(null)
        httpRequest.onload = () => {
            document.location.reload()
        }
    }
}

export default Ajax