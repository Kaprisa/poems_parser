import axios from 'axios'

setInterval(() => {
    axios.post('/poemsru/public/')
        .then((res) => document.querySelector('main').innerHTML = res.data )
        .catch(e => console.log(e))
}, 600000)
