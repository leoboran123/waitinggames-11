/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/extra.js ***!
  \*******************************/
var form = document.getElementById("search");
document.getElementById("search").onkeydown = function (e) {
  if (e.keyCode == 13) {
    form.submit();
  }
};
/******/ })()
;