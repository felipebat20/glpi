module.exports = async () => {
  return {
    verbose: true,
    "moduleFileExtensions": [
      "js",
      "json",
      "vue"
    ],
    "transform": {
      ".*\\.(vue)$": "vue-jest"
    }
  };
};