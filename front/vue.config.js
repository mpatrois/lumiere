const path = require('path');

module.exports = {
    baseUrl: '/',
    outputDir: path.resolve(__dirname, 'dist'),
    assetsDir: 'dist',
    devServer :{
        proxy: {
            '/api': {
                target: 'http://localhost:8000',
            }
        }
    }
}
