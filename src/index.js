import './sass/main.scss';
require.context('./images', true);
require.context('./icons', true);
import {scrollListener} from './js/app.js'


scrollListener();
