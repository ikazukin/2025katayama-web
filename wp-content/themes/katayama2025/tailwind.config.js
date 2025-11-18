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
    'bg-white',
    'text-katayama-blue',
    'text-katayama-navy',
    'text-white',
    'hover:bg-katayama-blue',
    'hover:bg-katayama-navy',
    'hover:bg-white',
    'hover:text-katayama-blue',
    'hover:text-white',
    'border-katayama-blue',
    'border-2',
  ],
  theme: {
    extend: {
      colors: {
        'katayama-blue': '#0056A3',      // メインカラー（Issue #24 - 40周年仕様）
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
