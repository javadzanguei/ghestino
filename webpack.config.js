const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const WebpackShellPlugin = require('webpack-shell-plugin');

module.exports = {
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
        ],
        stats: {
            children: true
        }
    },
    plugins: [
        new WebpackShellPlugin({onBuildStart:['echo "Webpack Start"'],
            onBuildEnd:['rtlcss public/assets/css/bootstrap-custom-ltr.css public/assets/css/bootstrap-custom.css']})
        // rtlcss public/assets/css/bootstrap-custom-ltr.css public/assets/css/bootstrap-custom.css
    ]
};
