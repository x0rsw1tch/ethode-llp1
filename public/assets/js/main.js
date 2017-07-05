
Vue.use(VueMaterial)

var app = new Vue({
    el: '#app'
})

Vue.material.registerTheme('default', {
    primary: {
        color: 'blue-grey',
        hue: '800'
    },
    accent: {
        color: 'deep-orange',
        hue: '400'
    },
    warn: { color: 'red', hue: '500' },
    background: 'blue-grey'
});

