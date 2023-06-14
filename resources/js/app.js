import './bootstrap';
import '../css/app.css';

import {createApp} from 'vue'
import ParserBar from './components/ParserBar.vue';
import ParserStatus from './components/ParserStatus.vue';

const app = createApp({
    components: {
        ParserBar,
        ParserStatus,
    }
})

app.mount('#app')

