/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/views/**/*.{html,php,js}',  // All HTML and PHP view files in the app/views folder
    './public/index.php',           // Entry point file
    './public/**/*.html',           // Any HTML files in the public directory
    './public/js/**/*.js',          // All JavaScript files in public/js
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

