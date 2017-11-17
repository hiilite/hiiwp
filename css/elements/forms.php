<?php if(false): ?><style><?php endif; ?>
button,
input,
optgroup,
select,
textarea {
	font-family: sans-serif;
	font-size: 100%;
	line-height: 1.15;
	margin: 0;
}

button,
input {
	overflow: visible;
}

button,
select {
	text-transform: none;
}

button,
html [type="button"],
[type="reset"],
[type="submit"] {
	-webkit-appearance: button;
}

button::-moz-focus-inner,
[type="button"]::-moz-focus-inner,
[type="reset"]::-moz-focus-inner,
[type="submit"]::-moz-focus-inner {
	border-style: none;
	padding: 0;
}

button:-moz-focusring,
[type="button"]:-moz-focusring,
[type="reset"]:-moz-focusring,
[type="submit"]:-moz-focusring {
	outline: 1px dotted ButtonText;
}

fieldset {
	border: 1px solid #bbb;
	margin: 0 2px;
	padding: 0.35em 0.625em 0.75em;
}

legend {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	color: inherit;
	display: table;
	max-width: 100%;
	padding: 0;
	white-space: normal;
}

progress {
	display: inline-block;
	vertical-align: baseline;
}

textarea {
	overflow: auto;
}

[type="checkbox"],
[type="radio"] {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 0;
}

[type="number"]::-webkit-inner-spin-button,
[type="number"]::-webkit-outer-spin-button {
	height: auto;
}

[type="search"] {
	-webkit-appearance: textfield;
	outline-offset: -2px;
}

[type="search"]::-webkit-search-cancel-button,
[type="search"]::-webkit-search-decoration {
	-webkit-appearance: none;
}

::-webkit-file-upload-button {
	-webkit-appearance: button;
	font: inherit;
}

label {
	color: #333;
	display: block;
	font-weight: 800;
	margin-bottom: 0.5em;
}

fieldset {
	margin-bottom: 1em;
}

input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
input[type="search"],
input[type="number"],
input[type="tel"],
input[type="range"],
input[type="date"],
input[type="month"],
input[type="week"],
input[type="time"],
input[type="datetime"],
input[type="datetime-local"],
input[type="color"],
textarea {
	color: #666;
	background: #fff;
	background-image: -webkit-linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0));
	-webkit-border-radius: 3px;
	border-radius: 0px;
	display: block;
	padding: 1em;
	width: 100%;	
	border: 1px solid rgba(203, 203, 203, 1); 
	font-size: 1rem;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="password"]:focus,
input[type="search"]:focus,
input[type="number"]:focus,
input[type="tel"]:focus,
input[type="range"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="week"]:focus,
input[type="time"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="color"]:focus,
textarea:focus {
	color: #222;
	border-color: #333;
	
	box-shadow: 0 1px 4px rgb(77, 144, 254), inset 0 1px 4px rgb(77, 144, 254);
}

select {
	-webkit-appearance: none;
	border: 1px solid #bbb;
	height: 3em;
	max-width: 100%;
    border-radius: 0;
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
    background-position: calc(100% - 20px) 50%, calc(100% - 15px) 50%, calc(100% - 43px) 30%;
    background-size: 5px 5px, 5px 5px, 1px 2em;
    background-repeat: no-repeat;
    padding-right: 3em;
    text-indent: 1em;
}

select:focus {
    background-image: linear-gradient(45deg,<?php echo Hii::$options['color_one'];?> 50%,transparent 50%),linear-gradient(135deg,transparent 50%,<?php echo Hii::$options['color_one'];?> 50%),linear-gradient(to right,#ccc,#ccc);
    background-position: calc(100% - 15px) 50%,calc(100% - 20px) 50%,calc(100% - 43px) 30%;
    background-size: 5px 5px,4px 5px,1px 2em;
    background-repeat: no-repeat;
    border-color: <?php echo Hii::$options['color_one'];?>;
    outline: 0;
}

input[type="radio"],
input[type="checkbox"] {
	margin-right: 0.5em;
	font-size: 1.5em;
    width: 15px;
}

input[type="radio"] + label,
input[type="checkbox"] + label {
	font-weight: 400;
}

button,
input[type="button"],
input[type="submit"] {
	background-color: #222;
	border: 0;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #fff;
	cursor: pointer;
	display: inline-block;
	font-size: 14px;
	font-size: 0.875rem;
	font-weight: 800;
	line-height: 1;
	padding: 1em 2em;
	text-shadow: none;
	-webkit-transition: background 0.2s;
	transition: background 0.2s;
}

input + button,
input + input[type="button"],
input + input[type="submit"] {
	padding: 0.75em 2em;
}

button.secondary,
input[type="reset"],
input[type="button"].secondary,
input[type="reset"].secondary,
input[type="submit"].secondary {
	background-color: #ddd;
	color: #222;
}

button:hover,
button:focus,
input[type="button"]:hover,
input[type="button"]:focus,
input[type="submit"]:hover,
input[type="submit"]:focus {
	background: #767676;
}

button.secondary:hover,
button.secondary:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="button"].secondary:hover,
input[type="button"].secondary:focus,
input[type="reset"].secondary:hover,
input[type="reset"].secondary:focus,
input[type="submit"].secondary:hover,
input[type="submit"].secondary:focus {
	background: #bbb;
}

/* Placeholder text color -- selectors need to be separate to work. */
::-webkit-input-placeholder {
	color: #333;
	font-family: "Libre Franklin", "Helvetica Neue", helvetica, arial, sans-serif;
}

:-moz-placeholder {
	color: #333;
	font-family: "Libre Franklin", "Helvetica Neue", helvetica, arial, sans-serif;
}

::-moz-placeholder {
	color: #333;
	font-family: "Libre Franklin", "Helvetica Neue", helvetica, arial, sans-serif;
	opacity: 1;
	/* Since FF19 lowers the opacity of the placeholder by default */
}

:-ms-input-placeholder {
	color: #333;
	font-family: "Libre Franklin", "Helvetica Neue", helvetica, arial, sans-serif;
}









