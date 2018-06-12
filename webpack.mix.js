// let mix = require('laravel-mix');
//
// mix.webpackConfig({
//     output: {
//         chunkFilename: `js/[name].${ mix.inProduction() ? '[chunkhash].' : '' }js`
//     }
// });
// /*
//  |--------------------------------------------------------------------------
//  | Mix Asset Management
//  |--------------------------------------------------------------------------
//  |
//  | Mix provides a clean, fluent API for defining some Webpack build steps
//  | for your Laravel application. By default, we are compiling the Sass
//  | file for the application as well as bundling up all the JS files.
//  |
//  */
//
// mix.js('resources/assets/js/app.js', 'public/js')
//     .js('resources/assets/chat-backend/js/app.js', 'public/chat-backend/js')
//     .sass('resources/assets/chat-backend/sass/app.scss', 'public/chat-backend/css')
//     .sass('resources/assets/sass/app.scss', 'public/css').extract(['vue', 'vue-router','moment','lightbox2'])
// ;
//
// if (mix.inProduction()){
//     mix.version();
// }

let mix = require('laravel-mix');
var CompressionPlugin = require("compression-webpack-plugin");
mix.webpackConfig({
    plugins: [
        new CompressionPlugin({
            asset: "[path].gz[query]",
            algorithm: "gzip",
            test: /\.(js|html)$/,
            threshold: 10240,
            minRatio: 0.8
        })
    ],
    output: {
        chunkFilename: `js/[name].${ mix.inProduction() ? '[chunkhash].' : '' }js`
    }
});
mix.options({
    uglify: {
        uglifyOptions: {
            sourceMap: false, // 关闭资源映射
            compress: {
                warnings: false,
                drop_console: true // 去除控制台输出代码
            },
            output: {
                comments: false // 去除所有注释
            }
        }
    }
});

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/chat-backend/js/app.js', 'public/chat-backend/js')
    .sass('resources/assets/chat-backend/sass/app.scss', 'public/chat-backend/css')
    .sass('resources/assets/sass/app.scss', 'public/css').extract(['vue', 'vue-router','moment','lightbox2']).version();
;