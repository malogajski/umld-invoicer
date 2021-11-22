module.exports = {
    mode: 'jit',
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        fontFamily: {
            'ibm': ['IBM Plex Sans', 'sans-serif']
        },
    },
  },
  variants: {
    extend: {
        tableLayout: ['hover', 'focus'],
    },
  },
  plugins: [
      require('@tailwindcss/forms')
  ],
}
