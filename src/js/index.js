import Alpine from 'alpinejs'
window.Alpine = Alpine 
Alpine.start()

/**
 * Utils
 */
import './utils/utils.js';

/**
 * Core
 */
import './core/SoftScroll.js'

/**
 * Styles
 */
import '../styles/main.scss'

/**
 * Importing theme scripts based on environment variables
 */
if (globals.themeScripts.wpml) { const LanguageSwitcher = import('./theme/LanguageSwitcher.js'); } // untested
if (globals.themeScripts.accordion) { const Accordion = import('./theme/Accordion.js'); } // untested
if (globals.themeScripts.modal) { const Modal = import('./theme/Modal.js'); } // untested

/**
 * Importing hot module
 */
if (module.hot) { module.hot.accept(); }