module.exports = {
  purge: ['resources/**/*.js', 'resources/**/*.twig', 'resources/**/*.css'],
  theme: {
    extend: {},
  },
  variants: {},
  plugins: [],
  experimental: 'all',
  future: {
    removeDeprecatedGapUtilities: true,
  },
  corePlugins: {
    container: false,
  },
}
