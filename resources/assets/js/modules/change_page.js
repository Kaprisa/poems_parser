import axios from 'axios'

let links

function changePageReq(navParentClass, page, hst = true, callback) {
    axios.get(`${page}&ajax=1`).then(res => {
        if (!res.data) return
        document.querySelector(`.${navParentClass}__link_active`).classList.remove(`${navParentClass}__link_active`)
        const p = parseInt(page.substr(page.indexOf('=') + 1, page.length))
        links[p].classList.add(`${navParentClass}__link_active`)
        const path = page.substring(0, page.lastIndexOf('=') + 1)
        if (p > 1) {
            links[0].setAttribute('href', `${path}${p - 1}`)
        }
        if (p < links.length - 3) {
            links[links.length - 1].setAttribute('href', `${path}${p + 1}`)
        }
        document.getElementById('items-holder').innerHTML = res.data
        if (callback instanceof Function) {
            callback()
        }
        const state = { page: page }
        if (hst){
            history.pushState(state, 'Poems.ru', state.page)
        }
        change_page(navParentClass)
    })
}

function change_page(navParentClass, callback = null) {
    if (!document.querySelector(`.${navParentClass}`)) return
    links = document.querySelectorAll(`.${navParentClass}__link`)
    links.forEach(item => {
        item.addEventListener('click', function(e){
            e.preventDefault()
            const href = this.getAttribute('href')
            changePageReq(navParentClass, href, true, callback)
        })
    })

    window.onpopstate = function(e) {
        if (!e.state) return
        changePageReq(navParentClass, e.state.page, false, callback)
    }
}

export default change_page