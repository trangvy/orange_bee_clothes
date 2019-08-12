const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/delete_brand.js', 'public/js/delete_brand.js')
   .js('resources/js/delete_category.js', 'public/js/delete_category.js')
   .js('resources/js/delete_post.js', 'public/js/delete_post.js')
   .sass('resources/sass/app.scss', 'public/css')

   .copy('resources/js/jquery.js', 'public/js')
   .copy('resources/js/jquery-1.11.3.min.js', 'public/js')
   .copy('resources/js/price-slider.js', 'public/js')
   .copy('resources/js/jquery.elevatezoom.js', 'public/js')
   .copy('resources/js/bootstrap.min.js', 'public/js')
   .copy('resources/js/owl.carousel.min.js', 'public/js')
   .copy('resources/js/jquery.meanmenu.js', 'public/js')
   .copy('resources/js/jquery.countdown.js', 'public/js')
   .copy('resources/js/main.js', 'public/js')
   .styles('resources/css/bootstrap.min.css', 'public/css/bootstrap.min.css')
   .styles('resources/css/font-awesome.min.css', 'public/css/font-awesome.min.css')
   .styles('resources/css/meanmenu.min.css', 'public/css/meanmenu.min.css')
   .styles('resources/css/owl.carousel.css', 'public/css/owl.carousel.css')
   .styles('resources/css/responsive.css', 'public/css/responsive.css')
   .styles('resources/css/style.css', 'public/css/style.css')
   .styles('resources/css/settings.css', 'public/css/settings.css')
   .styles('resources/css/clean-blog.min.css', 'public/css/clean-blog.min.css')
   .copy('resources/fonts/', 'public/fonts/')

   .copy('resources/rs-plugin/js/jquery.themepunch.revolution.min.js', 'public/rs-plugin/js')
   .copy('resources/rs-plugin/js/jquery.themepunch.tools.min.js', 'public/rs-plugin/js')
   .copy('resources/rs-plugin/js/rs.home.js', 'public/rs-plugin/js')
   .copy('resources/rs-plugin/font/', 'public/font/')
   .copy('resources/rs-plugin/assets/', 'public/assets/')
   .copy('resources/rs-plugin/css/settings.css', 'public/css/settings.css')

   .js('resources/js/cart.js', 'public/js')
   .js('resources/js/add_to_cart.js', 'public/js')
   .js('resources/js/admin_product.js', 'public/js/admin_product.js')
   .js('resources/js/admin_attribute.js', 'public/js/admin_attribute.js')
   .js('resources/js/product.js', 'public/js/product.js')

   .styles('resources/css/orange_style.css', 'public/css/orange_style.css')

