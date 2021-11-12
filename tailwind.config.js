module.exports = {
    // mode: 'jit',
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
        tableLayout: ['hover', 'focus'],
    },
  },
  plugins: [],
}
