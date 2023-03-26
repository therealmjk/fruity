import { createApp } from 'vue';
import Fruit from "./components/Fruit";
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faHeart} from '@fortawesome/free-solid-svg-icons'
import { faHeart as fasHeart } from '@fortawesome/free-regular-svg-icons'

library.add(faHeart, fasHeart)
createApp(Fruit)
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount('#app')