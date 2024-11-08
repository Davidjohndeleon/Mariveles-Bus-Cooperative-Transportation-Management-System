import './bootstrap';

import QrScanner from 'qr-scanner'; // if installed via package and bundling with a module bundler like webpack or rollup
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.QrScanner = QrScanner;

Alpine.start();
