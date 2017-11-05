import axios from 'axios'
import {dynamicPopup, showPopup} from './modules/popup'
import change_page from './modules/change_page'

setInterval(() => {
    axios.get('/poemsru/public?ajax=1')
        .then((res) => document.querySelector('main').innerHTML = res.data )
        .catch(e => console.log(e))
}, 600000)

document.querySelectorAll('.poems__link').forEach(item => {
    item.addEventListener('click', function (e) {
        e.preventDefault()
        axios.get(`/poemsru/public/poem/${this.getAttribute('data-id')}`).then(res => {
            const { text, name } = res.data
            const popup = document.querySelector('.poems__popup')
            popup.querySelector('.popup__title').innerHTML = name
            popup.querySelector('.popup__text').innerHTML = text
            showPopup(popup)
        }).catch(e => {
            console.error(e)
            dynamicPopup({ action: 'error', msg: 'Не удалось загрузить стихотворение :(' })
        })
    })
})

change_page('pagination');


