<?php if(false): ?><style><?php endif; ?>
.team-member .team-member-wrapper {
	margin: 1em;
	border-style: solid;
}

.team-member h5 {
	margin: 0;
}
.team-member figure {
	overflow:hidden;
	position: relative;
}
.team-member-image.square,
.team-member-image.circle {
	position: relative;
	height: 0;
	overflow: hidden;
	padding-top: 100%;
}
.team-member-image.square img,
.team-member-image.circle img {
	position: absolute;
	top: 0;
	left: 0;
}
.team-member-image.circle { border-radius: 100%; }

.team-member .button {
	width:100%;
	margin-bottom: 0;
}
.team-member.image-left .team-member-wrapper {
    display: flex;
}
.team-member.image-left .team-member-wrapper .team-member-image,
.team-member.image-left .team-member-wrapper .team-member-content {
    min-width: 50%;
}
.team-member.image-left .team-member-image.square,
.team-member.image-left .team-member-image.circle {
    padding-top: 50%;
}
.carousel-wrapper .team-member {
	float: left;
	width: 275px;
}

