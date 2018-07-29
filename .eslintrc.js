module.exports = {
    extends: [
        // add more generic rulesets here, such as:
        'eslint:recommended',
        'plugin:vue/recommended'
    ],
    parserOptions: {
        "ecmaVersion": 8,
        "ecmaFeatures": {
            "experimentalObjectRestSpread": true,
        },
    },
    rules: {
        // override/add rules settings here, such as:
        // 'vue/no-unused-vars': 'error'
        "no-console": "off",
        "no-eol-whitespace": {
            "ignore": ["empty-lines"]
        },
        "vue/require-prop-types": 'off',
        "indent": ["error", 4],
        "vue/max-attributes-per-line": [{"multiline": {"allowFirstLine": true}}],
        "vue/html-indent": ["error", 4, {
            "attribute": 1,
            "closeBracket": 0,
            "alignAttributesVertically": true,
            "ignores": []
        }]
    },
};