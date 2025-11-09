import darkMode from '../components/darkMode'

document.addEventListener('alpine:init', () => {
    // Register Alpine.js components
    // we have to do it here, and also our own Alpine stuff
    // so it won't conflict with livewire Alpine
    Alpine.data('darkMode', darkMode)
    //Alpine.data('languageSwitcher', languageSwitcher)
});
