const path = require('path');
const NODE_ENV = process.env.NODE_ENV || "dev";

module.exports = {
    entry: {
        addform: "./src/addform",
        main: "./src/main",
        authorization: "./src/authorization",
    },
    output: {
        path: __dirname + '/assets/js',
        filename: "[name].js",
    },
    devtool: NODE_ENV == 'dev' ? 'source-map' : null,
    watch: NODE_ENV == "dev",
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: ["/node_modules/"],
                use: [
                    {
                        loader: "babel-loader",
                        options: {
                            presets: ["env"],
                        }
                    }
                ]
            }
        ]
    }
}