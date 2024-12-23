/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./includes/**/*.php",
    "./views/**/*.php",
  ],
  // safelist: [
  //   'bg-red-500',    // Ensure these classes are always included
  //   'bg-blue-500',
  //   'text-xl',
  //   'hidden',        // Useful for conditionally rendered classes
  // ],
  theme: {
    extend: {
      fontFamily: {
        heading: ['Inter', 'sans-serif'],
        body: ['Roboto', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

