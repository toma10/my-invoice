module.exports = {
  purge: [
    './resources/js/**/*.js',
    './resources/js/**/*.vue',
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      maxWidth:{
        '8xl': '88rem',
      }
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ],
}
