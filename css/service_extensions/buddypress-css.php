#buddypress {
	background: white;
	width:100%;
}
body.buddypress.group-home,
body.buddypress.bp-user {
    background-color: #efefef;
}

.chosen-container-multi .chosen-choices li.search-field input[type="text"] {
	height:auto;
}
#buddypress #item-nav {
    min-width: 160px;
    flex: 1 1 auto;
    width: 20%;
}

#buddypress #item-body {
    flex: 1 1 auto;
    width: 80%;
    padding: 0 1em;
}

#buddypress #item-header {
    width: 100%;
}

#buddypress #item-nav div.item-list-tabs ul li {
    float: none;
}
#buddypress .dir-form {
    width: 100%;
}
.bp_members {
    background: rgb(245,245,245);
}
.bp_members #buddypress ,
.bp_group #buddypress {
	margin-top:-40px;
	width: 100%;
    display: flex;
    flex-wrap: wrap;
    background: white;
}
#buddypress div.item-list-tabs#subnav {
    width: 100%;
    margin: 5px auto;
    max-width: 100%;
}

body.single-item.groups #buddypress div#item-header #item-header-cover-image #item-header-content, body.single-item.groups #buddypress div#item-header #item-header-cover-image #item-actions {
	    clear: both;
    margin-left: 170px;
    margin-top: -140px;
    width: auto;
}


#buddypress div.pagination .pag-count {
	color:#eee;
}
.group-home #buddypress ul.item-list li img.avatar,
.bp-user #buddypress ul.item-list li img.avatar {
    border-radius: 100%;
}
.bpfb_actions_container, .bpfb_preview_container {
    margin-bottom: 0;
    float: left;
}
#buddypress div.activity-meta a {
    border: none !important;
    text-transform: capitalize;
    margin: 0;
    font-weight: normal;
    color: #a8a7a7;
}

#buddypress div.activity-meta {
    text-align: right;
}

#buddypress div.activity-meta a:hover {
    border: none;
}

#buddypress div.item-list-tabs#subnav {
	margin:0;
}
#buddypress form#whats-new-form #whats-new-content {
	padding-bottom:0;
}
.bpfb_actions_container:after,
.bpfb_toolbar_container:after,
#buddypress form#whats-new-form #whats-new-content:after {
	content: '';
	clear:both;
	display:block;
}

.group-home.buddypress .page-title {
	display:none;
}

#buddypress .item-body {
    clear: both;
}

@media (max-width:831px) {
	#buddypress #item-nav div.item-list-tabs ul li {
		display: inline-block;
	}
	
	body.single-item.groups #buddypress div#item-header #item-header-cover-image #item-header-content, body.single-item.groups #buddypress div#item-header #item-header-cover-image #item-actions {
	    clear: both;
	    margin-left: auto;
	    margin-top: auto;
	    width: 100%;
	}
	#buddypress ul.item-list li div.action {
		position:relative;
	}
}
#buddypress div#message p, #sitewide-notice p {
    clear: both;
}

.directory #buddypress div.item-list-tabs#subnav {
    width: auto;
}