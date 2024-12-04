/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        fontFamily: {
          body: ["Itim" ],
          banner: ["Outfit"],
          logo:["Delius"],
        }
      },
    },
    plugins: [
        require('daisyui'),
        require('tailwind-scrollbar'),

    ],
    daisyui: {
    themes: [
      {
        mytheme: {
          "primary": "#F9740E",
          "secondary": "#5A5A5A",
          "accent": "#FF0000",
          "neutral": "#757575",
          "base-100": "#ffffff",
          "alfa": "#F4F4F4",
        },
      },
      "dark",
      "cupcake",
    ],
  
  },
  }