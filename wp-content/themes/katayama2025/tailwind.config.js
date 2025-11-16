/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './src/**/*.{js,jsx,ts,tsx}',
    './template-parts/**/*.php'
  ],
  safelist: [
    'bg-katayama-blue',
    'bg-katayama-navy',
    'bg-katayama-accent',
    'bg-katayama-silver',
    'text-katayama-blue',
    'text-katayama-navy',
    'hover:bg-katayama-blue',
    'hover:bg-katayama-navy',
    'hover:text-katayama-blue',
    'border-katayama-blue',
  ],
  theme: {
    extend: {
      colors: {
        'katayama-blue': '#004B9A',      // メインカラー（Corporate Blue）
        'katayama-accent': '#A8C5DD',    // アクセント（淡いブルー）
        'katayama-navy': '#002244',      // サブカラー（ネイビー）
        'katayama-silver': '#E8EEF2',    // サブカラー（シルバー）
      },
      fontFamily: {
        sans: ['Noto Sans JP', 'Hiragino Kaku Gothic ProN', 'sans-serif'],
        heading: ['Inter', 'Noto Sans JP', 'sans-serif'],
      },
      aspectRatio: {
        '4/3': '4 / 3',
      },
    }
  },
  plugins: []
}
