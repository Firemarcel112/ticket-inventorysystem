/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    safelist: [

    ],
    content: [
        "./app/View/Components/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./public/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
  theme: {
        debugScreens: {
            position: ['top', 'right'],
        },
        extend: {
            colors: {
                'gray-day': "#eaeaea",

                'main': "rgb(189,13,13)",
                'light': 'rgba(209, 213, 219, 100)',
                'darkbg': 'rgba(51, 65, 85, 100)',
                'darktableOdd': 'rgba(52, 71, 97, 100)',
                'darktableEven': 'rgba(54, 69, 90, 100)',
                'darkthead' : 'rgba(29, 40, 64, 1)',
                'lighttableOdd' : 'rgb(250, 250, 255, 100)',
                'lighttableEven': 'rgba(248, 248, 250, 1)',
                'lightthead' : 'rgba(238, 240, 244, 1)',

                "condarkbg": 'rgba(30, 41, 59, 100)',
            },
            fontFamily: {
                'timesNewRoman': ["Times New Roman", "Helvetica", "sans-serif"]
            },
            translate: {
                'absolute': '-50%,0%',
            },
            backgroundImage: {
                'contentgradiantdarkleft': "rgba(102, 103, 101, 0.9)",
                'contentgradiantdarkright': "rgba(51, 65, 85, 0.91)",
                'darkimage': "linear-gradient(to right, rgba(51, 65, 85, 1), rgba(255,255,255, 0.7)), url('/secure_dnt/sabineblindow.jpg')",
                'contentgradiantlightleft': "rgba(20,39,53, 0.52)",
                'contentgradiantlightright': "rgba(209 213 219, 1 )",
                'lightimage': "linear-gradient(to left, rgba(20,39,53, 0.52), rgba(255,255,255, 1)), url('/secure_dnt/sabineblindow.jpg')",
                'darkbox': "rgba(51, 65, 85, 0.5)",
                'lightbox': "rgba(209 213 219, 0.5)",

            },

            backgroundSize: {
                '100%': "100% 100%",
            }
        },
  },
  plugins: [
   require("tailwindcss-debug-screens")
],
}
