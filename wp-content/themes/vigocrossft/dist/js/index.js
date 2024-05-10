/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./wp-content/themes/vigocrossft/src/index.js":
/*!****************************************************!*\
  !*** ./wp-content/themes/vigocrossft/src/index.js ***!
  \****************************************************/
/***/ (() => {

eval("/**\n * WordPress dependencies\n */\n\nvar registerBlockType = wp.blocks.registerBlockType;\nregisterBlockType('vigocrossft/custom-cta', {\n  // built-in attributes\n  title: 'Call to Action',\n  description: 'Block to generate a call to action',\n  icon: 'format-image',\n  category: 'layout',\n  // custom attributes\n  attributes: {\n    author: {\n      type: 'string'\n    }\n  },\n  // custom functions\n  edit: function edit(_ref) {\n    var attributes = _ref.attributes,\n      setAttributes = _ref.setAttributes;\n    return /*#__PURE__*/React.createElement(\"input\", {\n      value: attributes.author,\n      type: \"text\"\n    });\n  },\n  // built-in functions\n  save: function save() {\n    return /*#__PURE__*/React.createElement(\"p\", null, \"Front End\");\n  }\n});\n\n//# sourceURL=webpack://vigocrossft-wp/./wp-content/themes/vigocrossft/src/index.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./wp-content/themes/vigocrossft/src/index.js"]();
/******/ 	
/******/ })()
;