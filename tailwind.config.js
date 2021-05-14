module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                'main': ['Poppins', 'sans-serif']
            }
        },
        textColor: theme => ({
            ...theme('colors'),
            'primary': '#18d3d3'
        }),
        backgroundColor: theme => ({
            ...theme('colors'),
            'primary': '#18d3d3',
            'danger': '#ff0052e3'
        })
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
