/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        velora: {
          50: '#fbf8f3',
          100: '#f5efe4',
          200: '#ebdeca',
          300: '#dec7a8',
          400: '#cfa97f',
          500: '#c2905f',
          600: '#b27a4d',
          700: '#946140',
          800: '#794f38',
          900: '#644230',
        },
        daraz: {
          orange: '#f85606',
          dark: '#0f172a',
          card: '#1e293b',
        }
      },
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
