const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './src/**/*.html',
    './src/**/*.vue',
    './src/**/*.jsx'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      display: ['Grotesk Remix', 'Helvetica', 'Arial', 'sans-serif'],
      body: ['Karla', 'Helvetica', 'Arial', 'sans-serif']
    },
    colors: {
      black: '#000000',
      white: '#ffffff',
      gray: colors.trueGray,
      blue: {
        light: '#316C9B',
        dark: '#2F5676'
      },
      green: '#3AA8A9',
      creme: {
        light: '#F7F5F0',
        dark: '#EBE5D6',
      },
      orange: {
        light: '#D27756',
        dark: '#C15028'
      },
      purple: '#6671BA',
      lime: '#ABB576',
      yellow: '#E5C86B',
      transparent: 'transparent'
    },
    container: {
      center: true,
      padding: '1rem'
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
