<?php if(false): ?><style><?php endif; ?>


/* Heading Font */
.sp-table-caption,
.sp-template-countdown time span,
.sp-template-event-logos,
.sp-template .player-gallery-group-name,
.single-sp_staff .entry-header .entry-title strong {
    font-weight: normal;
    text-transform: uppercase;
}

/* SportsPress */
.sp-view-all-link {
    color: #a3a3a3;
}

.sp-view-all-link:hover {
    color: #00a69c;
}

.sp-highlight {
    background: #fff;
}

.sp-heading {
    background: #2b353e;
    color: #fff;
}

.sp-heading:hover,
.sp-heading a:hover {
    color: #fff;
}

.sp-table-caption {
    color: #fff;
    background: #2b353e;
    border-top: 8px solid <?php echo Hii::$options['color_one'];?>;
    padding: 0.625em 15px;
}

.sp-template-event-performance-icons tbody td {
    padding: 0.3125em 0.625em;
}

.sp-event-staff {
    background: #f4f4f4;
    border: 1px solid #e0e0e0;
}

.sp-table-wrapper .dataTables_paginate {
    background: #f4f4f4;
    color: #a3a3a3;
    border: 1px solid #e0e0e0;
}

.sp-tab-menu {
    border-bottom: 1px solid #e0e0e0;
}

.sp-tab-menu-item a {
    border-bottom: 4px solid transparent;
    margin: 0 5px -1px;
    padding: 5px;
}

.sp-tab-menu-item-active a {
    border-bottom-color: #00a69c;
}

.sp-template-countdown .event-name {
    font-weight: bold;
    text-align: left;
    font-size: 14px;
    padding: 0.635em 15px;
    color: #222;
}

.sp-template-countdown .event-name a {
    color: #222;
}

.sp-template-countdown .event-name,
.sp-template-countdown .event-venue,
.sp-template-countdown .event-league {
    background: #f4f4f4;
    border: 1px solid #e0e0e0;
}

.sp-template-countdown .event-venue,
.sp-template-countdown .event-league {
    border-top: none;
}

.sp-template-countdown .event-venue,
.sp-template-countdown .event-league {
    font-weight: normal;
}

.sp-template-countdown time span {
    border-right: 1px solid #e0e0e0;
    border-bottom: 1px solid #e0e0e0;
    background: #f4f4f4;
}

.sp-template-countdown time span:first-child {
    border-left: 1px solid #e0e0e0;
}

.sp-template-event-logos .sp-team-result {
    color: #fff;
    background: #00a69c;
}

.sp-template-event-venue .sp-google-map {
    margin: 0 -1px;
}

.sp-template-event-calendar #today {
    background: #fff;
}

.sp-template-event-calendar #prev a,
.sp-template-event-calendar #next a {
    color: #a3a3a3;
}

.sp-template-event-calendar #prev a:hover,
.sp-template-event-calendar #next a:hover {
    color: #00a69c;
}

.sp-template-event-blocks .event-title {
    color: #222;
    background: #fff;
    border: 1px solid #e0e0e0;
}

.sp-template-event-blocks .event-title a {
    color: #222;
}

.sp-template-event-blocks .event-results,
.sp-template-event-blocks .event-time {
    text-transform: none;
}

.sp-template-event-blocks .sp-event-date a,
.sp-template-event-blocks .sp-event-results a {
    color: inherit;
}

.sp-template-details dl {
    background: #f4f4f4;
    border: 1px solid #e0e0e0;
    margin-bottom: 20px;
}

.sp-template-post-content th,
.sp-template-post-content td {
    font-size: inherit;
    text-align: inherit;
}

.sp-tweets {
    border: 1px solid #e0e0e0;
    border-top: none;
}

.sp-footer-sponsors .sp-sponsors {
    border-top: 1px solid #e0e0e0;
}

.sp-template-tournament-bracket .sp-result {
    color: #fff;
    background: #00a69c;
}

.sp-template-tournament-bracket .sp-event-title:hover .sp-result {
    background: #00958c;
}

.sp-template-tournament-bracket .sp-event-venue {
    color: #a3a3a3;
}

.sp-header-scoreboard .sp-template-scoreboard {
    margin: 0;
}

.single-sp_team .has-post-thumbnail .entry-header .entry-title {
    float: left;
}

.single-sp_team .has-post-thumbnail .sp-excerpt {
    clear: left;
}

.single-sp_player .entry-header .entry-title strong {
    background: #00a69c;
    color: #fff;
}

.single-sp_staff .entry-header .entry-title strong {
    color: #00a69c;
}

.sp-template {
	margin-bottom: 1.25em;
}

.sp-template table:last-child {
	margin-bottom: 0;
}

.sp-template iframe {
	display: block;
	margin: 0 auto;
}

.sp-view-all-link {
	text-align: right;
	font-size: 14px;
}

.sp-table-caption,
.sp-template-countdown .event-name,
.opta-widget-container h2 {
	font-weight: normal;
	text-align: left;
	border: none;
	margin: 0 0 -1px;
	font-size: 16px;
	position: relative;
	z-index: 2;
}

.sp-table-caption h1,
.sp-table-caption h2,
.sp-table-caption h3,
.sp-table-caption h4,
.sp-table-caption h5,
.sp-table-caption h6 {
	margin: 0;
	font-size: inherit;
}

.sp-data-table tbody tr.odd {
	background: initial;
}

.sp-data-table tbody tr.sub {
	background: rgba(0,0,0,0.05);
}

.sp-table-wrapper .dataTables_paginate {
	margin-top: -1px;
	font-size: 14px;
	padding: 0.125em 0.625em;
}

.sp-template-countdown h5 {
	font-weight: bold;
	text-align: left;
	font-size: 14px;
	padding: 0.635em 15px;
	border: 1px solid transparent;
	border-top: none;
	margin: 0;
}

.sp-template-countdown {
	width: 100%;
	overflow: auto;
    zoom: 1;
}

.sp-template-countdown .sp-countdown {
	margin: 0;
}

.sp-template-countdown time span {
	box-sizing: border-box;
	display: block;
	float: left;
	width: 25%;
	text-align: center;
	padding: 14px 0;
	line-height: 1.25;
	font-size: 24px;
}

.sp-template-countdown time span small {
	display: block;
	clear: both;
	font-size: 14px;
}

.sp-template-event-calendar table {
	table-layout: fixed;
}

.sp-template-event-calendar #today {
	font-weight: bold;
}

.archive .sp-template-event-logos {
	margin-bottom: 2.5em;
}

.sp-template-event-logos-inline {
	margin-top: 0.5em;
	font-size: 36px;
	clear: both;
}

.sp-template-event-logos img {
	vertical-align: middle;
}

.sp-template-event-logos .sp-team-name {
	font-weight: inherit;
}

.sp-template-event-logos .sp-team-result {
	height: 1.5em;
	min-width: 1.5em;
	padding: 0 0.25em;
	box-sizing: border-box;
	text-align: center;
	line-height: 1.5em;
	font-weight: normal;
}

.sp-template-event-video {
    background: #000;
}

.sp-template-event-video .sp-table-caption {
	display: none;
}

.sp-event-staff {
	font-size: 14px;
	padding: 0.625em 15px;
}

.sp-template-event-performance-icons thead {
	display: none;
}

.sp-template-event-performance-icons td {
	border-width: 0;
}

.sp-template-event-performance-icons .sp-performance-icons {
	width: 40%;
	text-align: left;
	vertical-align: middle;
}

.sp-template-event-performance-icons tbody tr:first-child td {
	padding-top: 0.625em;
}

.sp-template-event-performance-icons tbody tr:last-child td {
	padding-bottom: 0.625em;
}

.sp-template-event-performance-icons .data-number {
	text-align: right;
	padding-left: 15px;
}

.sp-template-event-performance-icons .data-name {
	text-align: left;
	padding-right: 15px;
}

.sp-template-event-performance-icons td:first-child {
	border-left-width: 1px;
}

.sp-template-event-performance-icons td:last-child {
	border-right-width: 1px;
}

.sp-template-event-performance-icons tr:last-child td {
	border-bottom-width: 1px;
}

.sp-template-event-venue .sp-event-venue-map-row td {
	padding: 0;
	background: rgba(0, 0, 0, 0.05);
}

.sp-template-event-blocks .event-results,
.sp-template-event-blocks .event-time {
	font-size: 24px;
}

.sp-template-event-blocks .event-league,
.sp-template-event-blocks .event-season,
.sp-template-event-blocks .event-venue {
	display: block;
	font-weight: bold;
	font-size: 14px;
	clear: both;
	margin: 0 -0.5625em;
	padding: 0 0.625em 15px;
}

.sp-template-event-blocks .event-title {
	clear: both;
	font-weight: bold;
	font-size: 16px;
	margin: 0 -0.9375em -0.625em;
	padding: 0.625em 15px;
}

.widget .sp-template-event-blocks .event-results,
.widget .sp-template-event-blocks .event-time {
	font-size: 24px;
}

.widget .sp-template-event-blocks .event-title {
	margin: 0 -0.9375em -0.625em;
	padding: 0.625em 15px;
}

.sp-template-logo {
	margin: 0 auto 1.25em;
	text-align: center;
	clear: both;
	float: none;
	max-width: auto;
}

.sp-template-photo {
	max-width: none;
	width: 100%;
	text-align: center;
	margin: 0 0 1.25em 0;
	float: none;
}

.sp-template-photo img {
	width: 100%;
	display: block;
}

.sp-template-team-details {
	display: block;
	clear: both;
}

.sp-template-details dl {
	font-size: 14px;
	padding: 1em 15px 0;
	margin-bottom: 1.25em;
}

.sp-template-details dt {
	width: 40%;
	margin: 0 0 1em;
	float: left;
	clear: left;
}

.sp-template-details dd {
	overflow: hidden;
	margin: 0 0 1em 45%;
}

.sp-template-details dd img {
	vertical-align: middle;
	margin-right: 0.25em;
}

.sp-template .player-group-name,
.sp-staff-name {
	margin-top: 1.25em;
}

.sp-template .player-gallery-group-name,
.sp-staff-name {
	clear: both;
	font-size: 24px;
}

.sp-template-league-gallery dl {
	padding: 0.75em;
}