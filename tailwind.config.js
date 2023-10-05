/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
    theme: {
        extend : {
            colors: {
                "biru" : "#6d9ac4",
                "berem" : "#ee5684"
            }
        }
    },
  plugins: [],
}

