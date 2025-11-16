/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './src/**/*.{js,jsx,ts,tsx}',
    './template-parts/**/*.php'
  ],
  theme: {
    extend: {
      colors: {
        'katayama-blue': '#003366',
        'katayama-orange': '#FF6B35',
      },
      fontFamily: {
        sans: ['Noto Sans JP', 'sans-serif'],
      },
      aspectRatio: {
        '4/3': '4 / 3',
      },
    }
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ]
}
