# RTLCSS plugin for Laravel Mix

It's based on [webpack-rtl-plugin](https://github.com/romainberger/webpack-rtl-plugin).

# Install
```shell script
npm i rtlcss-webpack-mix-plugin -s
```

# Usage

```javascript
const RTLCSSPlugin = require('rtlcss-webpack-mix-plugin');

mix.webpackConfig({
    new RTLCSSPlugin({
        filename: '[name].rtl.css',
    })
});
```
