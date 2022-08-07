module.exports = {
  content: [
    './*.{html,js,php}'
  ],
  daisyui: {
    themes: [
      {
        mytheme: {
          "primary": "#4C1D95",
          "secondary": "#fb923c",    
          "accent": "#37CDBE",
          "neutral": "#3D4451",
          "base-100": "#f2f2f2",
          "info": "#3ABFF8",
          "success": "#36D399",
          "warning": "#ed1c1c",
          "error": "#F87272",
                  },
                },
              ],
            },
  theme: {
    container: {
      center: true,
    },
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require("daisyui")
  ],
}
