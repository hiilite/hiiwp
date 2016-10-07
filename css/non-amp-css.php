<style>
amp-carousel{
	overflow: hidden;
	display: block;
    position: relative;
}
amp-carousel[type=slides] .slide {
	position: absolute;
    top: 0;
    left: 0;
    bottom: 0; 
    right: 0;
    display: block;
    min-width: 100%;
    max-width: 100%;
    height: 100%;
    margin: auto;
}
.amp-carousel-button {
    position: absolute;
    box-sizing: border-box;
    top: 50%;
    height: 34px;
    width: 34px;
    border-radius: 2px;
    opacity: 1;
    pointer-events: all;
    background-color: rgba(0,0,0,.5);
    background-position: 50% 50%;
    background-repeat: no-repeat;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    visibility: visible;
    z-index: 10;
}
amp-carousel .amp-carousel-button.amp-disabled {
    -webkit-animation: none;
    animation: none;
    opacity: 0;
    visibility: hidden;
}
.amp-carousel-button-next {
    right: 16px;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="%23fff" viewBox="0 0 18 18"><path d="M9 3L7.94 4.06l4.19 4.19H3v1.5h9.13l-4.19 4.19L9 15l6-6z" /></svg>');
    background-size: 18px 18px;
}
.amp-carousel-button-prev {
    left: 16px;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="%23fff" viewBox="0 0 18 18"><path d="M15 8.25H5.87l4.19-4.19L9 3 3 9l6 6 1.06-1.06-4.19-4.19H15v-1.5z" /></svg>');
    background-size: 18px 18px;
}

</style>