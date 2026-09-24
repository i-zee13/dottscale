/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./site/**/*.html",
    "./site/**/*.js",
    "./allomate-WebNCMS/resources/views/layouts/Frontend/**/*.blade.php",
    "./allomate-WebNCMS/resources/views/frontend/**/*.blade.php",
  ],
  theme: {
    container: {
      center: true,
    },
    extend: {
      colors: {
        primary: "#212529",
        secondary: "#FFB237",
        bodybg: "#f6f6f6",
      },
      fontFamily: {
        primary: ["Geist", "sans-serif"],
        secondary: ["Geist", "sans-serif"],
      },
      screens: {
        xs: "414px",
      },
      transitionTimingFunction: {
        mil: "cubic-bezier(0, 0, 0.3642, 1)",
      },
      backgroundImage: {
        "menu-arrow": "url('/images/menu-arrow.svg')",
        "red-arrow": "url('/storage/media/red-arrow_1755666140.png')",
      },
    },
  },
  plugins: [],
};
