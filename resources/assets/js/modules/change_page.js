import axios from 'axios'

let links

function changePageReq(navParentClass, page, hst = true) {
    axios.get(`${page}&ajax=1`).then(res => {
        if (!res.data) return
        document.querySelector('.pagination__link_active').classList.remove('pagination__link_active')
        const p = parseInt(page.substr(page.indexOf('=') + 1, page.length))
        links[p].classList.add('pagination__link_active')
        if (p > 1) {
            links[0].setAttribute('href', `/poemsru/public/poems?page=${p - 1}`)
        }
        /*} else {
            links[0].remove()
        }*/
        if (p < links.length - 1) {
            links[links.length - 1].setAttribute('href', `/poemsru/public/poems?page=${p + 1}`)
        }
        // } else {
        //     links[links.length - 1].remove()
        // }
        document.getElementById('items-holder').innerHTML = res.data
        const state = { page: page }
        if (hst){
            history.pushState(state, 'Poems.ru', state.page)
        }
        change_page(navParentClass)
    })
}

function change_page(navParentClass) {
    if (!document.querySelector(`.${navParentClass}`)) return
    links = document.querySelectorAll(`.${navParentClass}__link`)
    links.forEach(item => {
        item.addEventListener('click', function(e){
            e.preventDefault()
            const href = this.getAttribute('href')
            changePageReq(navParentClass, href)
        })
    })

    window.onpopstate = function(e) {
        if (!e.state) return
        changePageReq(navParentClass, e.state.page, false)
    }
}

export default change_page