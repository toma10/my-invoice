module.exports = {
  purge: [
    './resources/js/**/*.js',
    './resources/js/**/*.vue',
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ],
}
