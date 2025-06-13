const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const fs = require('fs');

// Function to get all SCSS files in the directory
function getSCSSEntries() {
    const scssFolder = path.resolve(__dirname, 'assets/scss');
    const entries = {};

    fs.readdirSync(scssFolder).forEach(file => {
        if (file.endsWith('.scss')) {
            const name = path.basename(file, '.scss');
            entries[name] = path.resolve(scssFolder, file);
        }
    });
    return entries;
}

// Function to generate HTML plugins from Pug templates
function generateHTMLPlugins() {
    const htmlFolder = path.resolve(__dirname, 'assets/pug/pages/template');
    const plugins = [];

    // Recursive function to traverse directories
    function traverseDirectory(dir) {
        const files = fs.readdirSync(dir);

        files.forEach(file => {
            const filePath = path.join(dir, file);
            const stat = fs.statSync(filePath);

            if (stat.isDirectory()) {
                traverseDirectory(filePath); // Recursively traverse directories
            } else if (file.endsWith('.pug')) {
                const name = path.basename(file, '.pug');
                plugins.push(new HtmlWebpackPlugin({
                    template: filePath,
                    filename: path.resolve(__dirname, 'template', `${name}.html`), // Updated path
                    inject: false,
                }));
            }
        });
    }

    traverseDirectory(htmlFolder);
    return plugins;
}


module.exports = {
    mode: 'development', // or 'production'
    entry: {
        ...getSCSSEntries(),
    },
    output: {
        path: path.resolve(__dirname, 'assets/css/dist'),
        clean: true,
    },
    stats: {
        children: true
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            implementation: require('sass'),
                        },
                    },
                ],
            },
            {
                test: /\.pug$/,
                use: 'pug-loader',
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css', // Output CSS to assets/css folder
        }),
        ...generateHTMLPlugins(),
    ],
    devServer: {
        static: {
            directory: path.join(__dirname, 'assets/css/dist'),
        },
        port: 8080,
    },
};
