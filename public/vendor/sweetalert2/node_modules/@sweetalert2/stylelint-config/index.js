module.exports = {
  "extends": [
    "stylelint-config-standard",
    "stylelint-config-property-sort-order-smacss",
  ],
  "plugins": [
    "stylelint-csstree-validator",
    "stylelint-order",
    "stylelint-scss"
  ],
  "ignoreFiles": [
    "**/*.js",
    "**/*.ts"
  ],
  "rules": {
    "at-rule-no-unknown": null,
    "csstree/validator": true,
    "number-leading-zero": null,
    "no-descending-specificity": null,
    "scss/no-duplicate-dollar-variables": true,
  }
}
