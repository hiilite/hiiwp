if(document.getElementById('sr-fancy-gallery')) {
      Galleria.loadTheme('/wp-content/themes/hiiwp/hii-ddf/galleria/themes/classic/galleria.classic.js');
      Galleria.configure({
          height: 750,
          width:  "100%",
          showinfo: false,
          lightbox: true,
          imageCrop: false,
          imageMargin: 0,
          fullscreenDoubleTap: true,
          transition: 'fade',
          autoplay: 5000
      });
      Galleria.run('.sr-gallery');
  } 